<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_mask_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_LocMask");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("LM_Level_id"::text) as id',
								'(CASE WHEN "LM_Active" = '."'1'".' THEN '."'Active'".' WHEN "LM_Active" = '."'0'".' THEN '."'Inactive'".' END) as "LM_Active"'))
				 ->group_by("tblINV_LocMask.LM_Level_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("LM_Level_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("LM_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										// 'LOWER(CAST("LM_Width" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "LM_Active" = '."'1'".' THEN '."'Active'".' WHEN "LM_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblINV_LocMask.DateCreated DESC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_LocMask",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_LocMask"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
}
