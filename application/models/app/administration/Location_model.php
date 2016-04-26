<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_Location");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("LOC_Id") as id',
								'(CASE WHEN "LOC_Active" = '."'1'".' THEN '."'Active'".' WHEN "LOC_Active" = '."'0'".' THEN '."'Inactive'".' END) as "LOC_Active"'))
				 ->group_by("tblINV_Location.LOC_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("LOC_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("LOC_Name" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										// 'LOWER(CAST("LOC_Addrs" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										// 'LOWER(CAST("LOC_TelNum" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "LOC_Active" = '."'1'".' THEN '."'Active'".' WHEN "LOC_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblINV_Location.DateCreated DESC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblINV_Location",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_Location"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

}
