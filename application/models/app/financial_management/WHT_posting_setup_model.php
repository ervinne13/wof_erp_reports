<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wht_posting_setup_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_WHTPostingGroupSetup");
    }

  public function table_data($data){
		
		extract($data);

	   $this->db->select(array("*",
	   							'"a"."COA_AccountName" as "SalesAccount"',	
	    						'md5(CONCAT("WPS_WBPG_FK_Code","WPS_WPPG_FK_Code")) as id',	    
								'(CASE WHEN "WPS_Active" = '."'1'".' THEN '."'Active'".' WHEN "WPS_Active" = '."'0'".' THEN '."'Inactive'".' END) as "WPS_Active"'))
				 ->join('tblACC_ChartAccount as a','a.COA_Account_id = WPS_COA_FK_PayableAccountNo','left')		
				 ->group_by("tblACC_WHTPostingGroupSetup.WPS_WBPG_FK_Code,tblACC_WHTPostingGroupSetup.WPS_WPPG_FK_Code,a.COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("WPS_WBPG_FK_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("WPS_WPPG_FK_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("WPS_WHT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("WPS_WHT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("WPS_COA_FK_PayableAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "WPS_Active" = '."'1'".' THEN '."'Active'".' WHEN "WPS_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_WHTPostingGroupSetup.WPS_WBPG_FK_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_WHTPostingGroupSetup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());
		
		// print_r($this->db->error());
  // 			exit();

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_WHTPostingGroupSetup"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
