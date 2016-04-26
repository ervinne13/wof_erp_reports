<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_Retrieval");
    }

    private function _getWeekSumSubQuery($week_no) {
        return '(SELECT 
            COALESCE(((SELECT SUM("RVT_QtyRetrieved") FROM "tblINV_RetrievalToken" 
                WHERE "RVT_RV_DocNo" = "RV_DocNo" 
                AND "RVT_WeekNo" = ' . $week_no . ') 
            * 
            (SELECT "TTP_Price" FROM "tblINV_TTPAssumptions" 
                WHERE "TTP_SP_StoreID" = "RV_Location" 
                AND "TTP_Type" = \'0\')), 0)
            
            +
            
            COALESCE(((SELECT SUM("RVPT_QtyRetrieved") FROM "tblINV_RetrievalPisoToken" 
                WHERE "RVPT_RV_DocNo" = "RV_DocNo" 
                AND "RVPT_WeekNo" = ' . $week_no . ') 
            * 
            (SELECT "TTP_Price" FROM "tblINV_TTPAssumptions" 
                WHERE "TTP_SP_StoreID" = "RV_Location" 
                AND "TTP_Type" = \'1\')), 0)
                
            +

            COALESCE(((SELECT SUM("RVPC_QtyRetrieved") FROM "tblINV_RetrievalPisoCoin" 
                WHERE "RVPC_RV_DocNo" = "RV_DocNo" 
                AND "RVPC_WeekNo" = ' . $week_no . ') 
            * 
            (SELECT "TTP_Price" FROM "tblINV_TTPAssumptions" 
                WHERE "TTP_SP_StoreID" = "RV_Location" 
                AND "TTP_Type" = \'2\')), 0)

            +

            COALESCE(((SELECT SUM("RVTR_QtyRetrieved") FROM "tblINV_RetrievalTicket" 
                WHERE "RVTR_RV_DocNo" = "RV_DocNo" 
                AND "RVTR_WeekNo" = ' . $week_no . ') 
            * 
            (SELECT "TTP_Price" FROM "tblINV_TTPAssumptions" 
                WHERE "TTP_SP_StoreID" = "RV_Location" 
                AND "TTP_Type" = \'4\')), 0)

            AS "RV_Week' . $week_no . '")';
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array(
                    'RV_DocNo',
                    'RV_Period',
                    'RV_Location',
                    'RV_Company',
                    'RV_Status',
                    $this->_getWeekSumSubQuery(1),
                    $this->_getWeekSumSubQuery(2),
                    $this->_getWeekSumSubQuery(3),
                    $this->_getWeekSumSubQuery(4),
                    'MD5("RV_DocNo") AS id'))
                ->order_by("DateCreated DESC")
                ->group_by("tblINV_Retrieval.RV_DocNo");


        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("RV_DocDate") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("RV_DocDate") <=' => $queries['date-to']));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("RV_DocNo" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RV_Period" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RV_Location" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RV_Company" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblINV_Retrieval");
//        echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $result->num_rows(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function getMonthlyTotal($doc_no) {

        $result = $this->db->select("(
	COALESCE((SELECT COALESCE(SUM(\"RVT_QtyRetrieved\"),0) + COALESCE(SUM(\"RVT_Free\"),0) FROM \"tblINV_RetrievalToken\" WHERE \"RVT_RV_DocNo\" = '{$doc_no}'), 0)
            +
	COALESCE((SELECT SUM(\"RVPT_QtyRetrieved\") FROM \"tblINV_RetrievalPisoToken\" WHERE \"RVPT_RV_DocNo\" = '{$doc_no}'), 0)
            +
	COALESCE((SELECT SUM(\"RVPC_QtyRetrieved\") FROM \"tblINV_RetrievalPisoCoin\" WHERE \"RVPC_RV_DocNo\" = '{$doc_no}'), 0)) AS \"RV_MonthlyRunningTotal\"", FALSE)->get();

        $row = $result->row_array();

        return $row["RV_MonthlyRunningTotal"];
    }

    public function getRetrievalDateTotal($doc_no, $retrieval_date) {

        $result = $this->db->select("(
	COALESCE((SELECT COALESCE(SUM(\"RVT_QtyRetrieved\"),0) + COALESCE(SUM(\"RVT_Free\"),0) FROM \"tblINV_RetrievalToken\" WHERE \"RVT_RV_DocNo\" = '{$doc_no}' AND \"RVT_Date\" = '{$retrieval_date}'), 0)
            +
	COALESCE((SELECT SUM(\"RVPT_QtyRetrieved\") FROM \"tblINV_RetrievalPisoToken\" WHERE \"RVPT_RV_DocNo\" = '{$doc_no}' AND \"RVPT_Date\" = '{$retrieval_date}'), 0)
            +
	COALESCE((SELECT SUM(\"RVPC_QtyRetrieved\") FROM \"tblINV_RetrievalPisoCoin\" WHERE \"RVPC_RV_DocNo\" = '{$doc_no}' AND \"RVPC_Date\" = '{$retrieval_date}'), 0)) AS \"RV_MonthlyRunningTotal\"", FALSE)->get();

        $row = $result->row_array();

        return $row["RV_MonthlyRunningTotal"];
    }

    public function update($header, $details) {

        $status = 0;

        $header_where  = array('RE_DocNo' => $header["RE_DocNo"]);
        $details_where = array('RED_RE_DocNo' => $header["RE_DocNo"]);

        try {
            $this->db->trans_begin();

            //  RE_Reimbursement is always auto generated by details
            unset($header["RE_Reimbursement"]);

            //  update header
            $this->db->where($header_where)->update('tblCOM_Reimbursement', $header);
//            $updated_header_query = $this->db->where($header_where)->select('*')->get('tblCOM_Reimbursement');
//            $updated_header       = $updated_header_query->row_array();
            //  reset details
            $this->db->where($details_where)->delete('tblCOM_ReimbursementDetail');

            if ($details) {
                $reimbursement_amount = $this->_store_details($header, $details);

                //  update reimbursement amount
                $new_reimbursement = array(
                    'RE_Reimbursement' => $reimbursement_amount
                );
                $this->db->where($header_where)->update('tblCOM_Reimbursement', $new_reimbursement);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $status = 1;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
        }

        return $status;
    }

    private function _store_details($header, $details) {
        $total_amount = 0;
        foreach ($details as $value) {
            $empty = !array_filter($value);
            if (!empty($value) && !$empty) {
                $value['RED_RE_DocNo'] = $header['RE_DocNo'];
                $value['RED_withVAT']  = array_key_exists('RED_withVAT', $value) && $value['RED_withVAT'] ? '1' : '0';

                $total_amount += $value["RED_Amount"];

                $this->db->insert('tblCOM_ReimbursementDetail', add_data($value));
            }
        }

        return $total_amount;
    }

}
