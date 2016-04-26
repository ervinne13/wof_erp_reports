<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Vat_bus_posting_group_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_VATBusPostingGroup");
    }

  public function table_data($data){
	
	   extract($data);

	    $this->db->select(array("*",
	    						'md5("VBPG_Code") as id',
								'(CASE WHEN "VBPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "VBPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "VBPG_Active"'))
				 ->group_by("tblACC_VATBusPostingGroup.VBPG_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("VBPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VBPG_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "VBPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "VBPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_VATBusPostingGroup.VBPG_Code ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_VATBusPostingGroup",false));
		
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
