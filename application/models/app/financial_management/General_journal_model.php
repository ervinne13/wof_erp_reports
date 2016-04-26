<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_journal_model extends MY_Model {

    protected $table_name = "tblACC_GJHeader";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->table_name);
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array(
                    "GJ_DocNo",
                    "GJ_DocDate",
                    "GJ_RefNo",
                    "GJ_Status",
                    "GJ_Remarks",
                    'md5("GJ_DocNo") AS id'))
                ->limit($perPage, $offset)
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("GJ_DocNo" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJ_DocDate" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJ_RefNo" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJ_Status" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("GJ_Remarks" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
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
