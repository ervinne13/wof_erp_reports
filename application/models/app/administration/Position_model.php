<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Position_model extends MY_Model {
  
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_Position");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("P_Position_id") as id'))
	    		 ->group_by("tblCOM_Position.P_Position_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										"LOWER(CAST(".'"P_Position_id"'." as text)) LIKE" => '%'.strtolower($queries['search']).'%',
										"LOWER(CAST(".'"P_Position"'." as text)) LIKE" => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by("tblCOM_Position.P_Position_id ASC");
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_Position",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblCOM_Position"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

}
