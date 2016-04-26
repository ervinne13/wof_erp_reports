<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Debit_credit_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblACC_DCMDetail");
    }

    public function table_data($data) {

        extract($data);
        $this->db->select(array("DCMD_DCMType",
                    "DCMD_Description",
                    "DCMD_Location",
                    "DCMD_Amount",
                    "DCMD_CPC",
                    "DCMD_Comment",
                    "DCMD_AppliesToDocType",
                    "DCMD_AppliesToDocNo",
                    'md5("DCMD_LineNo"::text) AS id'))
                ->where(array('md5("DCMD_FK_DocNo")' => $id))
                ->limit($perPage, $offset)
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("DCMD_DCMType" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_Description" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_Location" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_Amount" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_CPC" as text)) LIKE'              => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_Comment" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_AppliesToDocType" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DCMD_AppliesToDocNo" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%'));
        }


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblACC_DCMDetail");
        
        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => 2,
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->get("tblACC_DCMDetail");
        return $result->row_array()['count'];
    }

}
