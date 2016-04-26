<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vat_posting_setup_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_VATPostingSetup");

    }

  public function table_data($data){
		
		extract($data);

	   $this->db->select(array("*",
	   							'"a"."COA_AccountName" as "SalesAccount"',
								'"b"."COA_AccountName" as "PurchaseAccount"',		
	    						'md5(CONCAT("VPS_VBPG_FK_Code","VPS_VPPG_FK_Code")) as id',
								'(CASE WHEN "VPS_Active" = '."'1'".' THEN '."'Active'".' WHEN "VPS_Active" = '."'0'".' THEN '."'Inactive'".' END) as "VPS_Active"'))
				 ->join('tblACC_ChartAccount as a','a.COA_Account_id = VPS_COA_FK_SalesAccountNo','left')
				 ->join('tblACC_ChartAccount as b','b.COA_Account_id = VPS_COA_FK_PurchaseAccountNo','left')
				 ->group_by("tblACC_VATPostingSetup.VPS_VBPG_FK_Code,tblACC_VATPostingSetup.VPS_VPPG_FK_Code,a.COA_Account_id,b.COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("VPS_VBPG_FK_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VPS_VPPG_FK_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VPS_Vat" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VPS_COA_FK_SalesAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("b"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VPS_COA_FK_PurchaseAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "VPS_Active" = '."'1'".' THEN '."'Active'".' WHEN "VPS_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_VATPostingSetup.VPS_VBPG_FK_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_VATPostingSetup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());
		
		// print_r($this->db->error());
  		// 	exit();

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count(),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
