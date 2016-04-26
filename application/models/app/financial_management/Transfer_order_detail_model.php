<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transfer_order_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_TODetail");
    }

    public function get_details($id) {
        $where  = array('md5("TOD_TO_DocNo")' => $id);
        $fields = array(
            'TOD_ItemType',
            'TOD_ItemNo',
            'TOD_ItemDescription',
            'TOD_Qty',
            'TOD_UOM',
            'TOD_UnitPrice',
            'TOD_Total',
            'TOD_Comment',
            'TOD_Comment',
            'TOD_QtyToReceive',
            'TOD_QtyReceived',
            'TOD_QtyToShip',
            'TOD_QtyShipped'
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function table_data($data) {

        extract($data);

        $fields = array(
            'TOD_ItemType',
            'TOD_ItemNo',
            'TOD_ItemDescription',
            'TOD_Qty',
            'TOD_UOM',
            'TOD_UnitPrice',
            'TOD_Total',
            'TOD_Comment',
            'TOD_RefFrom',
            'TOD_QtyToReceive',
            'TOD_QtyReceived'
        );

        $this->db
                ->select($fields)
                ->where(array('md5("TOD_TO_DocNo")' => $id))
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("TOD_ItemType" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_UOM" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_UnitPrice" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_Total" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_Comment" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_RefFrom" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_QtyToReceive" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("TOD_QtyReceived" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblCOM_TODetail");

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
