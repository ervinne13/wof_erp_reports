<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Item_uom_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_spec_datas($where) {

        $result = $this->db->select(array("IUC_Id", "IUC_Quantity", "IUC_FK_UOM_id"))
                ->where($where)
                ->get("tblINV_ItemUOMConv");

        return $result->result_array();
    }

    public function get_spec_uom_list($where=null) {
        $this->db->select(array("IUC_FK_Item_id","IUC_Id", "IUC_Quantity", "IUC_FK_UOM_id", "AD_Code", "AD_Desc"));
        $this->db->from("tblINV_ItemUOMConv iuc");
        $this->db->join("tblCOM_AttributeDetail ad", "iuc.IUC_FK_UOM_id = ad.AD_Id", "left");

        if($where){
            $this->db->where($where);
        }

        $result = $this->db->get();

        return $result->result_array();
    }

}
