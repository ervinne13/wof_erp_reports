<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vat_prod_posting_group_model extends MY_Model {


  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_VATProdPostingGroup");
    }

  public function table_data($data){
	
	   extract($data);

	    $this->db->select(array("*",
	    						'md5("VPPG_Code") as id',
								'(CASE WHEN "VPPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "VPPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "VPPG_Active"'))
				 ->group_by("tblACC_VATProdPostingGroup.VPPG_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("VPPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VPPG_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "VPPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "VPPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_VATProdPostingGroup.VPPG_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_VATProdPostingGroup",false));
		
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
