<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asset_disposal_detail_model extends MY_Model {

    protected $header_table = "tblINV_ADV";
    protected $detail_table = "tblINV_ADVDetail";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->detail_table);
    }

    public function table_data($data) {
        extract($data);

        $this->db->select(array('ADVD_ADV_DocNo',
            'ADVD_LineNo',
            'ADVD_ItemType',
            'ADVD_ItemDescription',
            'ADVD_AssetID',
            'ADVD_ItemNo',
            'ADVD_UOM',
            'ADVD_Qty',
            'ADVD_BookValue',
            'ADVD_TotalCost',
            'ADVD_Justification',
            'ADVD_Status',
            'md5("ADVD_ADV_DocNo"||\'-\'||"ADVD_LineNo") as trackid',
            'md5(concat("ADVD_ADV_DocNo","ADVD_LineNo")) as id'
        ));

        if (isset($id)) {
            $this->db->where(array('MD5("ADVD_ADV_DocNo")' => $id));
            $this->id = $id;
        }

        if (isset($where)) {
            $this->db->where($where);
        }

        if (isset($queries['statusFilter'])) {
            $this->db->where(array('LOWER(CAST("ADVD_Status" as text)) LIKE' => '%' . strtolower($queries['statusFilter']) . '%'));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("ADVD_ItemType" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_AssetID" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_UOM" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_BookValue" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_TotalCost" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_Justification" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("ADVD_Status" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
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
            $this->db->order_by($this->detail_table . '.DateCreated DESC');
        }

        $count = $this->db->query($this->db->get_compiled_select($this->detail_table, false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());

//        echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function get_details($id) {

        $where  = array('md5("ADVD_ADV_DocNo")' => $id);
        $fields = array(
            'ADVD_ItemType',
            'ADVD_ItemDescription',
            'ADVD_AssetID',
            'ADVD_ItemNo',
            'ADVD_UOM',
            'ADVD_Qty',
            'ADVD_BookValue',
            'ADVD_TotalCost',
            'ADVD_Justification',
            'ADVD_Status'
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->where(array('MD5("ADVD_ADV_DocNo")' => $this->id))
                ->get($this->detail_table);

        return $result->row_array()['count'];
    }

}
