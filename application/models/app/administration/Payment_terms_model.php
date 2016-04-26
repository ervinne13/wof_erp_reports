<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_terms_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_PaymentTerms");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("PT_Id") as id',
								'(CASE WHEN "PT_Active" = '."'1'".' THEN '."'Active'".' WHEN "PT_Active" = '."'0'".' THEN '."'Inactive'".' END) as "PT_Active"'))
				 ->group_by("tblACC_PaymentTerms.PT_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("PT_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("PT_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("PT_Days" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "PT_Active" = '."'1'".' THEN '."'Active'".' WHEN "PT_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_PaymentTerms.PT_Id ASC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_PaymentTerms",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_PaymentTerms"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
