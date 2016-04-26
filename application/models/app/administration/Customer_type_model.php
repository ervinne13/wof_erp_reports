<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_type_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_CustomerType");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("CT_Id",
	    						"CT_Description",
	    						'MD5("CT_Id") as id',
	    						'(CASE WHEN "CT_TinRequired" = '."'1'".' THEN '."'Required'".' WHEN "CT_TinRequired" = '."'0'".' THEN '."'Not Required'".' END) as "CT_TinRequired"',
	    						'(CASE WHEN "CT_Active" = '."'1'".' THEN '."'Active'".' WHEN "CT_Active" = '."'0'".' THEN '."'Inactive'".' END) as "CT_Active"'))
				 ->group_by("tblACC_CustomerType.CT_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CT_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CT_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "CT_TinRequired" = '."'1'".' THEN '."'Required'".' WHEN "CT_TinRequired" = '."'0'".' THEN '."'Not Required'".' END) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "CT_Active" = '."'1'".' THEN '."'Active'".' WHEN "CT_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_CustomerType.CT_Id ASC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_CustomerType",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count(),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
    }
}
