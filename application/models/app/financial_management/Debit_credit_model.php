<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Cash_receipt_model
 *
 * @author Ervinne Sodusta
 */
class Debit_credit_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblACC_DCMHeader");
    }

    public function table_data($data) {

        extract($data);

        //Doc. No.	Doc. Date	Customer ID	Customer Name	Ext. Doc. No.	Amount	Status


        $this->db->select(array("DCM_DocNo",
                    "DCM_DocDate",
                    "DCM_CustomerID",
                    "DCM_CustomerName",
                    "DCM_ExtDocNo",
                    "DCM_Amount",
                    "DCM_Status",
                    'md5("DCM_DocNo") as "id"'))
                ->limit($perPage, $offset)
                ->order_by("DateCreated DESC")
                ->group_by("tblACC_DCMHeader.DCM_DocNo");

        if (isset($queries['search'])) {

            $this->db->group_start();
            $this->db->where(array('LOWER(CAST("DCM_DocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("DCM_DocDate" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("DCM_CustomerID" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("DCM_CustomerName" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("DCM_ExtDocNo" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("DCM_Amount" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("DCM_Status" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%'));
            $this->db->group_end();
            
        }

        if(isset($queries['date-from'])){
			$this->db->where(array('DATE("DCM_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("DCM_DocDate") <=' => $queries['date-to']));
		}


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('DateCreated DESC');
        }


        $count = $this->db->query($this->db->get_compiled_select("tblACC_DCMHeader", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());


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
                ->get("tblACC_DCMHeader");
        return $result->row_array()['count'];
    }

}
