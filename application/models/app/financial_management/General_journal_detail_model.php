<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_journal_detail_model extends MY_Model {

    protected $table_name = "tblACC_GJDetail";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->table_name);
    }

    public function table_data($data) {

        extract($data);

        if (!isset($id)) {
            $id = "";   //  will simply not fetch anything
        }

        $this->db->select(array(
                    "GJD_PostingDate",
                    "GJD_AccountType",
                    "GJD_AccountNo",
                    "GJD_AccountName",
                    "GJD_Debit",
                    "GJD_Credit",
                    "GJD_Amount",
                    "GJD_CY",
                    "GJD_AmountLCY",
                    "GJD_CPC",
                    "GJD_Comment",
                    'md5("GJD_LineNo"::text) AS id'))
                ->where(array('md5("GJD_PFK_DocNo")' => $id))
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("GJD_PostingDate" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_AccountType" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_AccountNo" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_AccountName" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_Debit" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_Credit" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_Amount" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_CY" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_AmountLCY" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_CPC" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJD_Comment" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        if (isset($perPage) && isset($offset)) {
            $this->db->limit($perPage, $offset);
        }

        $result = $this->db->get($this->table_name);

        if ($result->num_rows() > 0) {
            return array(
                'rows' => $result->num_rows(),
                'data' => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function get_all_data() {

        return array(
            'rows' => $this->db->select('*')
                    ->get($this->table_name)->num_rows(),
            'data' => $this->db->select('*')
                    ->get($this->table_name)->result_array());
    }

}
