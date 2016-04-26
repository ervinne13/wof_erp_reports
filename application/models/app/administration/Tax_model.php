<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_Tax");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'MD5("TAX_Id") as id',
	    						'(CASE WHEN "TAX_Group" = '."'1'".' THEN '."'True'".' WHEN "TAX_Group" = '."'0'".' THEN '."'False'".' END) as "TAX_Group"',
	    						'(CASE WHEN "TAX_Taxable" = '."'1'".' THEN '."'True'".' WHEN "TAX_Taxable" = '."'0'".' THEN '."'False'".' END) as "TAX_Taxable"',
								'(CASE WHEN "TAX_Active" = '."'1'".' THEN '."'Active'".' WHEN "TAX_Active" = '."'0'".' THEN '."'Inactive'".' END) as "TAX_Active"'))
				 ->group_by("tblACC_Tax.TAX_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("TAX_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("TAX_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("TAX_Rate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "TAX_Group" = '."'1'".' THEN '."'True'".' WHEN "TAX_Group" = '."'0'".' THEN '."'False'".' END) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "TAX_Taxable" = '."'1'".' THEN '."'True'".' WHEN "TAX_Taxable" = '."'0'".' THEN '."'False'".' END) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "TAX_Active" = '."'1'".' THEN '."'Active'".' WHEN "TAX_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_Tax.TAX_Id ASC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_Tax",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_Tax"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
}
