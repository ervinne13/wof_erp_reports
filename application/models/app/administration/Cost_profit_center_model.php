<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cost_profit_center_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_CPCenter");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("CPC_Id",
	    						'MD5("CPC_Id") as id',
	    						"CPC_Desc",
	    						'(CASE WHEN "CPC_Active" = '."'1'".' THEN '."'Active'".' WHEN "CPC_Active" = '."'0'".' THEN '."'Inactive'".' END) as "CPC_Active"'))
				 ->group_by("tblCOM_CPCenter.CPC_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CPC_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CPC_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "CPC_Active" = '."'1'".' THEN '."'Active'".' WHEN "CPC_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblCOM_CPCenter.DateCreated DESC");
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_CPCenter",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblCOM_CPCenter"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  	}
}
