<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_Company");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("COM_DocNo") as id',
								'(CASE WHEN "COM_Active" = '."'1'".' THEN '."'Active'".' WHEN "COM_Active" = '."'0'".' THEN '."'Inactive'".' END) as "COM_Active"'))
				 ->group_by("tblCOM_Company.COM_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("COM_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COM_Name" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COM_Address" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COM_PhoneNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COM_FaxNum" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("COM_Email" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "COM_Active" = '."'1'".' THEN '."'Active'".' WHEN "COM_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblCOM_Company.COM_Id ASC');
		}
		

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_Company",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());
		
		//$result = $this->db->get("tblCOM_Module");

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblCOM_Company"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

}
