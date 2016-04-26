<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fixed_asset_posting_group_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_FAPostingGroup");
    }

  public function table_data($data){
		
		extract($data);

	   $this->db->select(array("*",
	   							'"a"."COA_AccountName" as "ACA"',
								'"b"."COA_AccountName" as "ADA"',
								'"c"."COA_AccountName" as "DEA"',
								'"d"."COA_AccountName" as "DEAS"',
	    						'md5("FAPG_Code") as "id"', 	    					
								'(CASE WHEN "FAPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "FAPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "FAPG_Active"'))
				 ->join('tblACC_ChartAccount as a','a.COA_Account_id = FAPG_COA_FK_ACANo','left')
				 ->join('tblACC_ChartAccount as b','b.COA_Account_id = FAPG_COA_FK_ADANo','left')
				 ->join('tblACC_ChartAccount as c','c.COA_Account_id = FAPG_COA_FK_DEANo','left')
				 ->join('tblACC_ChartAccount as d','d.COA_Account_id = FAPG_COA_FK_DEANoS','left')
				 ->group_by("tblACC_FAPostingGroup.FAPG_Code,a.COA_Account_id,b.COA_Account_id,c.COA_Account_id,d.COA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("FAPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("FAPG_COA_FK_ACANo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("FAPG_COA_FK_ADANo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("FAPG_COA_FK_DEANo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("b"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("c"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("d"."COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "FAPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "FAPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_FAPostingGroup.FAPG_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_FAPostingGroup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());
		
		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_FAPostingGroup"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
