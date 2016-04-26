<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_supplier_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_ItemSupplier");
    }


  public function get_spec_datas($where){

		$result =	$this->db->select(array("*"))
	 						 ->where($where)
	 						 ->get("tblINV_ItemSupplier");

	    return $result->result_array();
  }

}
