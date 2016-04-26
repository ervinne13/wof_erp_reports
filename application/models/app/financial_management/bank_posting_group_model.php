<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_posting_group_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_BankPostingGroup");
    }

  public function table_data($data){
		
		extract($data);

	    extract($data);

	    $this->db->select(array("*",
	    						'md5("BPG_Code") as "id"', 
	    						'COA_AccountName', 
								'(CASE WHEN "BPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "BPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "BPG_Active"'))
				 ->join('tblACC_ChartAccount','COA_Account_id = BPG_COA_FK_AccountNo','left')
				 ->group_by("tblACC_BankPostingGroup.BPG_Code,COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("BPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "BPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "BPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_BankPostingGroup.BPG_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_BankPostingGroup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_BankPostingGroup"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
