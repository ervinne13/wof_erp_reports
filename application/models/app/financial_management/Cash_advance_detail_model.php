<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cash_advance_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_CADetail");
    }

    public function get_details($id) {

        $where  = array('md5("CAD_CA_DocNo")' => $id);
        $fields = array(
            'CAD_Particular',
            'CAD_Qty',
            'CAD_Amount',
            'CAD_Total'
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function table_data($data) {

        extract($data);

        $fields = array(
            'CAD_Particular',
            'CAD_Qty',
            'CAD_Amount',
            'CAD_Total'
        );

        $this->db
                ->select($fields)
                ->where(array('md5("CAD_CA_DocNo")' => $id))
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("CAD_Particular" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CAD_Qty" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CAD_Amount" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CAD_Total" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblCOM_CADetail");

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $result->num_rows(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

}
