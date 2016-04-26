<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Identifier_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_Identifier");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("ID_Id") as "id"', 
								'(CASE WHEN "ID_Active" = '."'1'".' THEN '."'Active'".' WHEN "ID_Active" = '."'0'".' THEN '."'Inactive'".' END) as "ID_Active"'))
				 ->group_by("tblINV_Identifier.ID_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("ID_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("ID_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "ID_Active" = '."'1'".' THEN '."'Active'".' WHEN "ID_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblINV_Identifier.DateCreated DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_Identifier",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		//$result = $this->db->get("tblCOM_Module");

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_Identifier"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
}
