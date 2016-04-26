<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Working_trial_balance_model
 *
 * @author Ervinne Sodusta
 */
class Working_trial_balance_model extends MY_Model {

    protected $table = "tblACC_GLEntry";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->table);
    }

    public function table_data($data) {

        extract($data);

        //  Get the accounts 
        $accounts_query_string = 'SELECT DISTINCT ON ("COA_Account_id") 
                                    "COA_Account_id", "COA_AccountName", "GL_EntryNo"
                               FROM "tblACC_ChartAccount"
                                    LEFT JOIN "tblACC_GLEntry" ON "COA_Account_id" = "GL_AccountID"
                               WHERE "GL_EntryNo" IS NOT NULL AND "COA_Active" = \'1\'
                               GROUP BY "COA_Account_id", "GL_EntryNo"';
        $accounts_query        = $this->db->query($accounts_query_string);

        $period_condition_clause = "";

        if (isset($dateFrom) && isset($dateTo)) {
            $period_condition_clause .= "AND \"GL_DatePosted\" < '{$dateTo}' AND \"GL_DatePosted\" >= '{$dateFrom}'";
        }

        $search_clause = "";

        if (isset($company)) {
            $search_string = strtolower($company);
            $search_clause = " AND LOWER(CAST(\"GL_Company\" as text)) LIKE '{$search_string}' ";
        }

        $query = '
            SELECT DISTINCT "COA_Account_id", "COA_AccountName",
                (SELECT previous_gl."GL_Amount"
                 FROM "tblACC_GLEntry" previous_gl
                 WHERE previous_gl."GL_AccountID" = "COA_Account_id"
                   AND previous_gl."GL_DatePosted" < current_gl."GL_DatePosted"
                   AND previous_gl."GL_Status" = \'Closing Balance\'
                 ORDER BY previous_gl."GL_DatePosted" DESC LIMIT 1) AS "GL_Beginning_Balance", 
                 "GL_Amount" AS "GL_Ending_Balance",
                 "GL_EntryNo", -- Prevent engries with the same values to be treated as one
                 "GL_FK_BT_BookID",                 
                 "GL_CPC",
                 "GL_Credit",
                 "GL_Debit",
                 "COA_Active",
                 "GL_Status",
                 "GL_DatePosted"
              FROM "tblACC_ChartAccount"
              JOIN "tblACC_GLEntry" current_gl ON ("COA_Account_id" = "GL_AccountID")
              WHERE "COA_Active" = \'1\' 
                AND "GL_Status" = \'Open\'
                ' . $period_condition_clause . ' 
                ' . $search_clause . ' 
              ORDER BY "COA_Account_id", "GL_DatePosted" DESC              
        ';

        $result = $this->db->query($query);

//        echo $query;
//        exit();

        if ($result->num_rows() > 0) {
            return array(
                'rows' => $accounts_query->num_rows(),
                'data' => $result->result_array()
            );
        } else {
            return FALSE;
        }
    }

    public function record_count() {
        $result = $this->db
                ->select('COUNT(*)')
                ->where('"COA_Active"', '1')
                ->get("tblACC_ChartAccount");
        return $result->row_array()['count'];
    }

    public function lock($company, $lockMonth, $lockYear) {

        $where = array(
            "COM_Id" => $company
        );

        $update = array(
            "COM_LockDate" => $this->_month_and_year_to_last_date($lockMonth, $lockYear)
        );

        return $this->db->where($where)->update("tblCOM_Company", $update);
    }

    public function unlock($company, $lockMonth, $lockYear) {
        $where = array(
            "COM_Id" => $company
        );

        //  use previous month
        $lockMonth = $lockMonth - 1;
        $update    = array(
            "COM_LockDate" => $this->_month_and_year_to_last_date($lockMonth, $lockYear)
        );

        return $this->db->where($where)->update("tblCOM_Company", $update);
    }

    private function _month_and_year_to_last_date($month, $year) {
        $date = $year . "-" . ($month + 1) . "-1";
        return date("Y-m-t", strtotime($date));
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Adapter/Consolidation Functions - Check if this could be placed on a facade instead as this is a mix of (mostly) model and view functionality">
    private function _generate_filter_by_account_id_where_clause($accounts) {

        $clause         = "";
        $accoun_id_list = array();

        foreach ($accounts AS $account) {
            array_push($accoun_id_list, "'" . $account["COA_Account_id"] . "'");
        }

        if (count($accoun_id_list) > 0) {
            $clause = ' AND "GL_AccountID" IN (' . implode(",", $accoun_id_list) . ')';
        }

        return $clause;
    }

    private function _map_entry_to_account(&$map, $entry) {

        $entry_for_consolidation = $this->_generate_entry_for_consolidation($entry);

        if (array_key_exists($entry["COA_Account_id"], $map)) {   //  if there is an already existing record for this account
            $map[$entry["COA_Account_id"]] = $this->_consolidate_entries($map[$entry["COA_Account_id"]], $entry_for_consolidation);
        } else {
            $map[$entry["COA_Account_id"]] = $entry_for_consolidation;
        }
    }

    private function _map_entry_to_account_and_cost_center(&$map, $entry) {

        $entry_for_consolidation = $this->_generate_entry_for_consolidation($entry);

        $key = $entry["COA_Account_id"] . "_" . $entry["GL_CPC"];

        if (array_key_exists($key, $map)) {   //  if there is an already existing record for this account
            $consolidated_entry           = $this->_consolidate_entries($map[$key], $entry_for_consolidation);
            $consolidated_entry["GL_CPC"] = $entry["GL_CPC"];

            $map[$key] = $consolidated_entry;
        } else {
            $entry_for_consolidation["GL_CPC"] = $entry["GL_CPC"];

            $map[$key] = $entry_for_consolidation;
        }
    }

    private function _consolidate_entries($entry1, $entry2) {

        $consolicated_entry = array(
            'COA_Account_id'       => $entry1['COA_Account_id'],
            'COA_AccountName'      => $entry1['COA_AccountName'],
            'GL_Beginning_Balance' => $entry1['GL_Beginning_Balance'],
        );

//  get later date
        $entry1_date = strtotime($entry1["GL_DatePosted"]);
        $entry2_date = strtotime($entry2["GL_DatePosted"]);

        if ($entry1_date > $entry2_date) {
            $consolicated_entry["GL_DatePosted"] = $entry1["GL_DatePosted"];
        } else {
            $consolicated_entry["GL_DatePosted"] = $entry2["GL_DatePosted"];
        }

        $consolicated_entry["GL_Ending_Balance"]         = $entry1["GL_Ending_Balance"] + $entry2["GL_Ending_Balance"];
        $consolicated_entry["GL_Credit"]                 = $entry1["GL_Credit"] + $entry2["GL_Credit"];
        $consolicated_entry["GL_Debit"]                  = $entry1["GL_Debit"] + $entry2["GL_Debit"];
        $consolicated_entry["GL_Disbursement_Credit"]    = $entry1["GL_Disbursement_Credit"] + $entry2["GL_Disbursement_Credit"];
        $consolicated_entry["GL_Disbursement_Debit"]     = $entry1["GL_Disbursement_Debit"] + $entry2["GL_Disbursement_Debit"];
        $consolicated_entry["GL_Cash_Receipt_Credit"]    = $entry1["GL_Cash_Receipt_Credit"] + $entry2["GL_Cash_Receipt_Credit"];
        $consolicated_entry["GL_Cash_Receipt_Debit"]     = $entry1["GL_Cash_Receipt_Debit"] + $entry2["GL_Cash_Receipt_Debit"];
        $consolicated_entry["GL_Sales_Credit"]           = $entry1["GL_Sales_Credit"] + $entry2["GL_Sales_Credit"];
        $consolicated_entry["GL_Sales_Debit"]            = $entry1["GL_Sales_Debit"] + $entry2["GL_Sales_Debit"];
        $consolicated_entry["GL_General_Journal_Credit"] = $entry1["GL_General_Journal_Credit"] + $entry2["GL_General_Journal_Credit"];
        $consolicated_entry["GL_General_Journal_Debit"]  = $entry1["GL_General_Journal_Debit"] + $entry2["GL_General_Journal_Debit"];

        return $consolicated_entry;
    }

    private function _generate_entry_for_consolidation($entry) {

        $entry_for_consolidation = array(
            'COA_Account_id'       => $entry['COA_Account_id'],
            'COA_AccountName'      => $entry['COA_AccountName'],
            'GL_Beginning_Balance' => $entry['GL_Beginning_Balance'],
            'GL_Ending_Balance'    => $entry['GL_Ending_Balance'],
            'GL_Credit'            => $entry['GL_Credit'],
            'GL_Debit'             => $entry['GL_Debit'],
            'GL_DatePosted'        => $entry['GL_DatePosted'],
        );

        if ($entry_for_consolidation["GL_Beginning_Balance"] == null) {
            $entry_for_consolidation["GL_Beginning_Balance"] = 0;
        } else {
//  compute ending balance
//  = [Beginning Balance] + [Total Debit] - [Total Credit]
            $entry_for_consolidation['GL_Ending_Balance'] = $entry_for_consolidation["GL_Beginning_Balance"];

            if ($entry['GL_Debit']) {
                $entry_for_consolidation['GL_Ending_Balance'] += $entry['GL_Debit'];
            }

            if ($entry['GL_Credit']) {
                $entry_for_consolidation['GL_Ending_Balance'] -= $entry['GL_Credit'];
            }
        }

        if ($entry['GL_Credit'] == null) {
            $entry_for_consolidation['GL_Credit'] = 0;
        }

        if ($entry['GL_Debit'] == null) {
            $entry_for_consolidation['GL_Debit'] = 0;
        }

        $entry_for_consolidation["GL_Disbursement_Credit"]    = 0;
        $entry_for_consolidation["GL_Disbursement_Debit"]     = 0;
        $entry_for_consolidation["GL_Cash_Receipt_Credit"]    = 0;
        $entry_for_consolidation["GL_Cash_Receipt_Debit"]     = 0;
        $entry_for_consolidation["GL_Sales_Credit"]           = 0;
        $entry_for_consolidation["GL_Sales_Debit"]            = 0;
        $entry_for_consolidation["GL_General_Journal_Credit"] = 0;
        $entry_for_consolidation["GL_General_Journal_Debit"]  = 0;

        switch ($entry["GL_FK_BT_BookID"]) {
            case "Disbursement":
                if ($entry['GL_Credit']) {
                    $entry_for_consolidation["GL_Disbursement_Credit"] = $entry['GL_Credit'];
                }
                if ($entry['GL_Debit']) {
                    $entry_for_consolidation["GL_Disbursement_Debit"] = $entry['GL_Debit'];
                }
                break;
            case "Cash Receipt":
                if ($entry['GL_Credit']) {
                    $entry_for_consolidation["GL_Cash_Receipt_Credit"] = $entry['GL_Credit'];
                }
                if ($entry['GL_Debit']) {
                    $entry_for_consolidation["GL_Cash_Receipt_Debit"] = $entry['GL_Debit'];
                }
                break;
            case "Sales":
                if ($entry['GL_Credit']) {
                    $entry_for_consolidation["GL_Sales_Credit"] = $entry['GL_Credit'];
                }
                if ($entry['GL_Debit']) {
                    $entry_for_consolidation["GL_Sales_Debit"] = $entry['GL_Debit'];
                }
                break;
            case "General Journal":
                if ($entry['GL_Credit']) {
                    $entry_for_consolidation["GL_General_Journal_Credit"] = $entry['GL_Credit'];
                }
                if ($entry['GL_Debit']) {
                    $entry_for_consolidation["GL_General_Journal_Debit"] = $entry['GL_Debit'];
                }
                break;
        }

        return $entry_for_consolidation;
    }

    private function _adapt_entry_to_view($entry) {

        if ($entry["GL_Beginning_Balance"] == 0) {
            $entry["GL_Beginning_Balance"] = "-";
        } else if ($entry["GL_Beginning_Balance"] < 0) {
            $entry["GL_Beginning_Balance"] = "(" . number_format(doubleval($entry["GL_Ending_Balance"]) * -1, 2) . ")";
        } else {
            $entry["GL_Beginning_Balance"] = number_format(doubleval($entry["GL_Ending_Balance"]), 2);
        }

        if ($entry["GL_Ending_Balance"] < 0) {
            $entry["GL_Ending_Balance"] = "(" . number_format(doubleval($entry["GL_Ending_Balance"]) * -1, 2) . ")";
        } else {
            $entry["GL_Ending_Balance"] = number_format(doubleval($entry["GL_Ending_Balance"]), 2);
        }

        if (doubleval($entry["GL_Credit"]) == 0) {
            $entry["GL_Credit"] = "-";
        } else {
            $entry["GL_Credit"] = "(" . number_format(doubleval($entry["GL_Credit"]), 2) . ")";
        }

        if (doubleval($entry["GL_Debit"]) == 0) {
            $entry["GL_Debit"] = "-";
        } else {
            $entry["GL_Debit"] = number_format(doubleval($entry["GL_Debit"]), 2);
        }

        $replace_with_dash_keys = array(
            'GL_Disbursement_Credit',
            'GL_Disbursement_Debit',
            'GL_Cash_Receipt_Credit',
            'GL_Cash_Receipt_Debit',
            'GL_Sales_Credit',
            'GL_Sales_Debit',
            'GL_General_Journal_Credit',
            'GL_General_Journal_Debit'
        );

        foreach ($entry AS $key => $value) {
            $value = doubleval($value);
            if (in_array($key, $replace_with_dash_keys) && $value == 0) {
                $entry[$key] = "-";
            } else if (in_array($key, $replace_with_dash_keys)) {
                $entry[$key] = number_format($value, 2);
            }
        }

        return $entry;
    }

    /**
     * Use adapter instead of sub queries for performance boost
     * @param type $data
     * @return array
     */
    public function adapt_data_to_view($data) {

        $adapted_data = array();
        $data_map     = array();

//  map entries
        foreach ($data AS $entry) {
            $this->_map_entry_to_account($data_map, $entry);
        }

        foreach ($data_map AS $mapped_entry) {
            array_push($adapted_data, $this->_adapt_entry_to_view($mapped_entry));
        }

        return $adapted_data;
    }

//  </editor-fold>

    public function close_book($date_from, $date_to) {

        $this->db->trans_begin();

        //  Create new record for closed book
        //  Each entries are consolidated by their account and cost center
        $gl_entries   = $this->table_data(array('dateFrom' => $date_from, 'dateTo' => $date_to));
        $gl_entry_map = array();

        if (count($gl_entries["data"]) > 0) {

            //  set status of all documents in range
            $update       = array('GL_Status' => 'Closed');
            $where_clause = "\"GL_DatePosted\" < '{$date_to}' AND \"GL_DatePosted\" >= '{$date_from}'";
            $this->db
                    ->where($where_clause)
                    ->update("tblACC_GLEntry", $update);

            //  generate the map/consolidated entries
            foreach ($gl_entries["data"] AS $entry) {
                $this->_map_entry_to_account_and_cost_center($gl_entry_map, $entry);
            }

            //  insert entries to the general ledger
            foreach ($gl_entry_map AS $consolidated_gl_entry) {
                $gl_closing_balance_entry = $this->_create_closing_balance_entry($consolidated_gl_entry, $date_from);
                $this->db->insert("tblACC_GLEntry", $gl_closing_balance_entry);
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    private function _create_closing_balance_entry($consolidated_gl_entry, $date_from) {

        $time  = strtotime($date_from);
        $month = date("F", $time);
        $year  = date("Y", $time);

        $gl_doc_no = $month . " " . $year;

        $CI      = &get_instance();
        $user_id = $CI->session->userdata('U_User_id');

        $next_entry_no = $this->db
                ->query('SELECT "GL_EntryNo" + 1 AS "GL_EntryNo" FROM "tblACC_GLEntry" ORDER BY "GL_EntryNo" DESC LIMIT 1')
                ->row_array();

        return array(
            '"GL_EntryNo"'     => $next_entry_no["GL_EntryNo"],
            '"GL_DocType"'     => '"Closing"',
            '"GL_DocNo"'       => $gl_doc_no,
            '"GL_DocDate"'     => $consolidated_gl_entry["GL_DatePosted"],
            '"GL_AccountType"' => '"G\L Account"',
            '"GL_AccountID"'   => $consolidated_gl_entry["COA_Account_id"],
            '"GL_AccountName"' => $consolidated_gl_entry["COA_AccountName"],
            '"GL_Debit"'       => $consolidated_gl_entry["GL_Debit"],
            '"GL_Credit"'      => $consolidated_gl_entry["GL_Credit"],
            '"GL_Amount"'      => $consolidated_gl_entry["GL_Ending_Balance"],
            '"GL_CPC"'         => $consolidated_gl_entry["GL_CPC"],
            '"GL_Status"'      => '"Closing Balance"',
            '"GL_PostedBy"'    => $user_id,
            '"GL_DatePosted"'  => date("Y-m-d H:i:s", time()),
            '"GL_DateCreated"' => date("Y-m-d H:i:s", time()),
        );
    }

}
