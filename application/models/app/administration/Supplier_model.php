<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_Supplier");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("S_Id") as id',
								'(CASE WHEN "S_Active" = '."'1'".' THEN '."'Active'".' WHEN "S_Active" = '."'0'".' THEN '."'Inactive'".' END) as "S_Active"'))
				 ->group_by("S_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("S_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("S_Name" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("S_Address" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("S_Addr_City" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("S_Addr_State" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("S_TelNum" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("S_TinNum" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "S_Active" = '."'1'".' THEN '."'Active'".' WHEN "S_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblCOM_Supplier.S_Id ASC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_Supplier",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblCOM_Supplier"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  public function get_dropdown_result($params){
  	$result =	$this->db->select(array('S_Id','S_Name'))
						 ->where(array('S_Active' => '1'))
						 ->or_having(array(
										'LOWER(CAST("S_Id" as text)) LIKE' => '%'.strtolower($params['q']).'%',
										'LOWER(CAST("S_Name" as text)) LIKE' => '%'.strtolower($params['q']).'%',
										))
						 ->limit($params['limit'])
						 ->group_by('S_Id')
    		 			 ->get("tblCOM_Supplier");
    return $result->result_array();
  }

}
