<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Requisition_detail_model extends MY_Model {

    private $id = NULL;

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RQDetail");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array('RQD_RQ_DocNo',
                    'RQD_ItemType',
                    'RQD_ItemNo',
                    'RQD_ItemDescription',
                    'RQD_Location',
                    'RQD_Qty',
                    'RQD_UOM',
                    'RQD_UnitCost',
                    'RQD_Amount',
                    'RQD_Comment',
                    'RQD_RefDocNo',
                    'RQD_RefFrom',
                    'RQD_RefTo',
                    'RQD_RefStatus',
                    'RQD_Status',
                    'RQD_LineNo',
                    'md5("RQD_RQ_DocNo"||\'-\'||"RQD_LineNo") as trackid',
                    'md5(concat("RQD_RQ_DocNo","RQD_LineNo")) as id'))
                ->join('tblINV_ItemType', 'IT_Id = RQD_ItemType', 'left')
                ->join('tblCOM_PODetail', 'POD_RefFrom = RQD_RQ_DocNo AND POD_RefFromLineNo	 = RQD_LineNo', 'left')
                ->group_by("RQD_RQ_DocNo,RQD_LineNo,IT_Id");

        if (isset($id)) {
            $this->db->where(array('MD5("RQD_RQ_DocNo")' => $id));
            $this->id = $id;
        }

        if (isset($where)) {
            $this->db->where($where);
        }

        if (isset($queries['statusFilter'])) {
            $this->db->where(array('LOWER(CAST("RQD_Status" as text)) LIKE' => '%' . strtolower($queries['statusFilter']) . '%'));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("RQD_RQ_DocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_ItemType" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Location" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_UOM" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_UnitCost" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Amount" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Comment" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_RefDocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_RefFrom" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_RefTo" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_RefStatus" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Status" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
            ));
        }


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('tblINV_RQDetail.DateCreated DESC');
        }

        $count = $this->db->query($this->db->get_compiled_select("tblINV_RQDetail", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());

        // $result = $this->db->get("tblCOM_Module");
        // print_r($this->db->error());
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
                ->where(array('MD5("RQD_RQ_DocNo")' => $this->id))
                ->get("tblINV_RQDetail");

        return $result->row_array()['count'];
    }

    public function getPending($id) {

        $result = $this->db->select(array('"RQD_ItemType" as "POD_ItemType"',
                    '"RQD_ItemNo" as "POD_ItemNo"',
                    '"RQD_ItemDescription" as "POD_ItemDescription"',
                    '"RQD_Location" as "POD_Location"',
                    '"RQD_Qty" as "POD_Qty"',
                    '"RQD_UOM" as "POD_UOM"',
                    '"RQD_UnitCost" as "POD_UnitPrice"',
                    '("RQD_Qty" * "RQD_UnitCost") as "POD_Total"',
                    '"RQD_Currency" as "POD_Currency"',
                    '"RQD_Comment" as "POD_Comment"',
                    '"RQD_RQ_DocNo" as "POD_RefFrom"',
                    '("RQD_Qty" * "RQD_UnitCost" * .10) as "POD_EstimatedCost"',
                    '"IM_VATProductPostingGroup" as "POD_VAT"',
                    '"IM_WHTProductPostingGroup" as "POD_WHT"',
                    '"RQD_Qty" as "POD_QtyToReceive"',
                    '"RQD_LineNo" as "POD_RefFromLineNo"',
                    'md5(concat("RQD_RQ_DocNo","RQD_LineNo")) as id'))
                ->join('tblINV_Item', 'IM_Item_id = RQD_ItemNo', 'left')
                ->where_in('md5(concat("RQD_RQ_DocNo","RQD_LineNo"))', json_decode($id, true))
                ->get('tblINV_RQDetail');
        return $result->result_array();
    }

    public function getTOPending($data) {

        extract($data);

        $this->db->select(array(
            '"RQD_RQ_DocNo"',
            '"RQD_ItemType"',
            '"RQD_ItemNo"',
            '"RQD_ItemDescription"',
            '"RQD_Location"',
            '"RQD_Qty"',
            '"RQD_UOM"',
            '"RQD_Comment"',
            '"RQD_RefFrom"',
            'md5(concat("RQD_RQ_DocNo","RQD_LineNo")) as id'));
        $this->db->join('tblINV_Item', 'IM_Item_id = RQD_ItemNo', 'left');
        $this->db->where(array(
            "RQD_Status" => "Approved",
            "IM_ForTO"   => "1"
        ));

        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("DateCreated") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("DateCreated") <=' => $queries['date-to']));
        }

        if (isset($queries['location'])) {
            $this->db->where(array('RQD_Location' => $queries['location']));
        }

        if (isset($queries['company'])) {
//            $this->db->where(array('RQD_Location' => $queries['company']));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("RQD_RQ_DocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_ItemType" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Location" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_UOM" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_Comment" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQD_RefFrom" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblINV_RQDetail");

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
