<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_ledger_model extends My_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_CustomerLedger");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("CL_DocNo",
                    "CL_DocType",
                    "CL_DocDate",
                    "CL_DocAmount",
                    "CL_RemAmount",
                    "CL_DueDate",
                    'md5("CL_DocNo") AS id'))
                ->limit($perPage, $offset)
                ->order_by("CL_DatePosted DESC");
        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("CL_DocNo" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CL_DocDate" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CL_DocAmount" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CL_RemAmount" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CL_DueDate" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblCOM_CustomerLedger");

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function add_data($data) {
        $this->db->insert('"tblCOM_CustomerLedger"', $data);
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->get("tblCOM_CustomerLedger");
        return $result->row_array()['count'];
    }

}
