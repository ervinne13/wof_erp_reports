<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_setup_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_DepartmentClass");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("DEP_Id",
	    						'md5("DEP_Id") as "id" ',
	    						"DEP_Description",
	    						'(CASE WHEN "DEP_Active" = '."'1'".' THEN '."'Active'".' WHEN "DEP_Active" = '."'0'".' THEN '."'Inactive'".' END) as "DEP_Active"'))
				 ->group_by("DEP_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("DEP_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DEP_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "DEP_Active" = '."'1'".' THEN '."'Active'".' WHEN "DEP_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblCOM_DepartmentClass.DateCreated ASC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_DepartmentClass",false));
		//echo $this->db->last_query();
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblCOM_DepartmentClass"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
  public function add_data($data){

  	$department = $data['DS_FK_Position_id'];
  	unset($data['DS_FK_Position_id']);

  	$this->db->trans_start();
  	$this->db->insert('tblCOM_DepartmentClass',add_data($data));
  	foreach ($department as $key => $value) {
  			$this->db->insert('tblCOM_DepartmentSetup',array('DS_FK_Position_id'=>$value,'DS_FK_Department_id'=>$data['DEP_Id']));
  	}
  	$this->db->trans_complete();

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
  public function update_main_data($where,$data){
	  
    $this->db->trans_start();
	
	  $this->db->where($where)
  			 ->update('tblCOM_DepartmentClass',update_data($data['position']));

  
  	foreach ($data['delete'] as $key => $value) {
  		$this->db->where(array('md5("DS_FK_Department_id")' => $where['md5("DEP_Id")']))
  				 ->where(array('DS_FK_Position_id' => $value))
  				 ->delete("tblCOM_DepartmentSetup");

  	}

  	foreach ($data['add'] as $key => $value) {
  		$this->db->insert("tblCOM_DepartmentSetup",array('DS_FK_Position_id' => $value,'DS_FK_Department_id' => $data['position']['DEP_Id']));
  	}
  	
  	$this->db->trans_complete();
  	
  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
   public function get_spec_location_array($where){

    $result = $this->db->select(array('DS_FK_Position_id'))
                       ->where($where)
                       ->get("tblCOM_DepartmentSetup");
      return $result->result_array();
  }

}
