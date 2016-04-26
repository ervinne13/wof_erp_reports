<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_type_setup_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_spec_location_array($where) {

        $result = $this->db->select(array('ITS_FK_Module_id', 'M_Description', 'IT_Id', 'IT_Description'))
                ->join('tblCOM_Module', 'tblCOM_Module.M_Module_id = tblINV_ItemTypeSetup.ITS_FK_Module_id', 'left')
                ->join('tblINV_ItemType', 'tblINV_ItemType.IT_Id = tblINV_ItemTypeSetup.ITS_FK_ItemType_id', 'left')
                ->where($where)
                ->get("tblINV_ItemTypeSetup");
        return $result->result_array();
    }

    public function getModuleItemTypes($module_id) {

        $this->db->select('ITS_FK_ItemType_id');
        $this->db->where(array(
            '"ITS_FK_Module_id"' => $module_id
        ));

        $query             = $this->db->get('"tblINV_ItemTypeSetup"');
        $item_type_entries = $query->result_array();

        $item_types = array();
        foreach ($item_type_entries AS $item_type) {
            array_push($item_types, $item_type['ITS_FK_ItemType_id']);
        }

        return $item_types;
    }

}
