<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory_posting_group_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_InvPostingGroup");
    }

  public function table_data($data){
		
		extract($data);

	    extract($data);

	    $this->db->select(array("*",
	    						'"a"."COA_AccountName" as "AccountNamea"',
								'"b"."COA_AccountName" as "AccountNameb"',
	    						'md5("IPG_Code") as "id"', 
								'(CASE WHEN "IPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "IPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "IPG_Active"'))
				 ->join('tblACC_ChartAccount as a','a.COA_Account_id = IPG_COA_FK_AccountNo','left')
				 ->join('tblACC_ChartAccount as b','b.COA_Account_id = IPG_COA_FK_SalesAccountNo','left')
				 ->group_by("tblACC_InvPostingGroup.IPG_Code,a.COA_Account_id,b.COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("IPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("b"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "IPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "IPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_InvPostingGroup.IPG_Code ASC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_InvPostingGroup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		// print_r($this->db->error());
		// exit();

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count(),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  	}
}
