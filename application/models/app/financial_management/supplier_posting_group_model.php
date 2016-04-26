<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_posting_group_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_SupplierPostingGroup");

    }

  public function table_data($data){
		
		extract($data);

	    extract($data);

	    $this->db->select(array("*",
	    						'md5("SPG_Code") as "id"', 
	    						'COA_AccountName', 
								'(CASE WHEN "SPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "SPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "SPG_Active"'))
				 ->join('tblACC_ChartAccount','COA_Account_id = SPG_COA_FK_AccountNo','left')
				 ->group_by("tblACC_SupplierPostingGroup.SPG_Code,COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("SPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COA_Account_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "SPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "SPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_SupplierPostingGroup.SPG_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_SupplierPostingGroup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_SupplierPostingGroup"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
