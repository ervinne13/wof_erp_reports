<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_Customer");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("C_Id",
	    						"C_Name",
	    						'MD5("C_Id") as id',
	    						"C_CompanyName",	    						
	    						"C_TIN_No",	    						
	    						"C_Status",	    						
	    						'(CASE WHEN "C_Active" = '."'1'".' THEN '."'Active'".' WHEN "C_Active" = '."'0'".' THEN '."'Inactive'".' END) as "C_Active"'))
				 ->group_by("tblACC_Customer.C_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("C_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("C_Name" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("C_TIN_No" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("C_CompanyName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "C_Active" = '."'1'".' THEN '."'Active'".' WHEN "C_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_Customer.C_Id ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_Customer",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_Customer"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  	}
 	
}
