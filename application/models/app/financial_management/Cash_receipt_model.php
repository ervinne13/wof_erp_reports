<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Cash_receipt_model
 *
 * @author Ervinne Sodusta
 */
class Cash_receipt_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblACC_CRJHeader");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("CRJ_DocNo",
                    'DATE("CRJ_DocDate") as "CRJ_DocDate"',
                    "CRJ_Amount",
                    "CRJ_CustomerID",
                    "CRJ_CustomerName",
                    "CRJ_ExtDocNo",
                    "CRJ_Location",
                    "tblINV_StoreProfile.SP_FK_CompanyID AS CRJ_Location_Company",
                    "CRJ_Status",
                    'md5("CRJ_DocNo") as "id"'))
                ->group_start()
                ->where_in('CRJ_Location', array_column($this->session->userdata('location'), 'SP_StoreID'))
                ->or_where('CRJ_Status', NULL)
                ->group_end()
                ->join('tblINV_StoreProfile', 'tblACC_CRJHeader.CRJ_Location = tblINV_StoreProfile.SP_StoreID', 'left')
                ->group_by("tblACC_CRJHeader.CRJ_DocNo,SP_FK_CompanyID");

        if (isset($queries['search'])) {
            
            $this->db->group_start();

            $this->db->where(array('LOWER(CAST("CRJ_DocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%' ));
            $this->db->or_where(array('LOWER(CAST("CRJ_DocDate" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%' ));
            $this->db->or_where(array('LOWER(CAST("CRJ_Amount" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%' ));
            $this->db->or_where(array('LOWER(CAST("CRJ_CustomerID" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%' ));
            $this->db->or_where(array('LOWER(CAST("CRJ_CustomerName" as text)) LIKE' => '%' . strtolower($queries['search']) . '%' ));
            $this->db->or_where(array('LOWER(CAST("CRJ_ExtDocNo" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%' ));
            $this->db->or_where(array('LOWER(CAST("CRJ_Location" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%' ));
            $this->db->group_end();
           
        }

        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("CRJ_DocDate") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("CRJ_DocDate") <=' => $queries['date-to']));
        }


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('tblACC_CRJHeader.DateCreated DESC');
        }

        $count = $this->db->query($this->db->get_compiled_select("tblACC_CRJHeader", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());

        // print_r($this->db->error());
        // exit();

        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->where_in('CRJ_Location', array_column($this->session->userdata('location'), 'SP_StoreID'))
                ->get("tblACC_CRJHeader");
        return $result->row_array()['count'];
    }

    public function get_remaining_amount($document_number, $detail_entry_no, $applies_to_doc_no) {

        $applies_to_amount_where = array(
            'CRJD_PFK_DocNo'      => $document_number,
            "CRJD_AppliesToDocNo" => $applies_to_doc_no
        );

        if ($detail_entry_no) {
            $applies_to_amount_where["CRJD_LineNo"] = $detail_entry_no;
        }

        $applies_to_amount_query = $this->db->select("CRJD_AppliesToAmount")->from("tblACC_CRJDetail")->where($applies_to_amount_where)->get();
        $applies_to_amount_data  = $applies_to_amount_query->row_array();

        $this->db->select('SUM("CRJD_AppliedAmount") AS total_applied_amount');
        $this->db->from("tblACC_CRJDetail");
        $this->db->where(array("CRJD_AppliesToDocNo" => $applies_to_doc_no));

        if ($detail_entry_no) {
            $this->db->where("\"CRJD_LineNo\" != '{$detail_entry_no}'");
        }

        $total_amount_data_query = $this->db->get();
        $total_amount_data       = $total_amount_data_query->row_array();

        $crj_amount           = $applies_to_amount_data['CRJD_AppliesToAmount'];
        $total_applied_amount = $total_amount_data["total_applied_amount"];

        if ($crj_amount) {

            if ($total_applied_amount) {
                return doubleval($crj_amount) - doubleval($total_applied_amount);
            } else {
                return doubleval($crj_amount);
            }
        } else {
            return 0;
        }
    }

    public static function generate_empty_document() {

        return array(
            'CRJ_CustomerID'   => null,
            'CRJ_CustomerName' => null,
            'CRJ_ExtDocNo'     => null,
            'CRJ_Remarks'      => null,
            'CRJ_Amount'       => null,
            'CRJ_BankAccount'  => null,
            'CRJ_Location'     => null,
            'CRJ_Status'       => null,
            'CreatedBy'        => null,
            'DateCreated'      => null,
            'ModifiedBy'       => null,
            'DateModified'     => null,
        );
    }

}
