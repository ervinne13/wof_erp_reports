<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_posting_group_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_CustomerPostingGroup");
    }

  public function table_data($data){
		
		extract($data);

	    extract($data);

	    $this->db->select(array("*",
	    						'md5("CPG_Code") as "id"', 
	    						'COA_AccountName', 
								'(CASE WHEN "CPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "CPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "CPG_Active"'))
				 ->join('tblACC_ChartAccount','COA_Account_id = CPG_COA_FK_AccountNo','left')
				 ->group_by("tblACC_CustomerPostingGroup.CPG_Code,COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "CPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "CPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_CustomerPostingGroup.CPG_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_CustomerPostingGroup",false));
		
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
