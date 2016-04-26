<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_Item");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("IM_Item_id") as "id"', 
									'(CASE WHEN "IM_Active" = '."'1'".' THEN '."'Active'".' WHEN "IM_Active" = '."'0'".' THEN '."'Inactive'".' END) as "IM__Active"'))
	    	 ->join('tblINV_ItemType', "tblINV_ItemType.IT_Id = tblINV_Item.IM_FK_ItemType_id AND  tblINV_ItemType.IT_Services = '1' ")
				 ->group_by("tblINV_Item.IM_Item_id,IT_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("IM_Item_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IM_Sales_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "IM_Active" = '."'1'".' THEN '."'Active'".' WHEN "IM_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
										));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblINV_Item.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblINV_Item",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());
		//$result = $this->db->get("tblCOM_Module");

		// print_r($this->db->error());
  // 	exit();

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_Item"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
