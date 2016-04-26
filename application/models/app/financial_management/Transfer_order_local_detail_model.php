<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer_order_local_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_TOLDetail");
    }

    public function get_details($id) {
        $where  = array('md5("TOLD_TO_DocNo")' => $id);
        $fields = array(
            'TOLD_ItemType',
            'TOLD_ItemNo',
            'TOLD_ItemDescription',
            'TOLD_Qty',
            'TOLD_UOM',
            'TOLD_UnitPrice',
            'TOLD_Total',
            'TOLD_Comment',
            'TOLD_Comment',
            'TOLD_QtyToReceive',
            'TOLD_QtyReceived',
            'TOLD_QtyToShip',
            'TOLD_QtyShipped'
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function table_data($data) {

        extract($data);

        $fields = array(
            'TOLD_ItemType',
            'TOLD_ItemNo',
            'TOLD_ItemDescription',
            'TOLD_Qty',
            'TOLD_UOM',
            'TOLD_UnitPrice',
            'TOLD_Total',
            'TOLD_Comment',
            'TOLD_RefFrom',
        );

        $this->db
                ->select($fields)
                ->where(array('md5("TOLD_TO_DocNo")' => $id))
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("TOLD_ItemType" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_UOM" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_UnitPrice" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_Total" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_Comment" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOLD_RefFrom" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
               ));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblCOM_TOLDetail");

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
