<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buyer_setup_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_BuyerClass");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("B_Id",
	    						'md5("B_Id") as "id" ',
	    						"B_Description",
	    						'(CASE WHEN "B_Active" = '."'1'".' THEN '."'Active'".' WHEN "B_Active" = '."'0'".' THEN '."'Inactive'".' END) as "B_Active"'))
				 ->group_by("B_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("B_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("B_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "B_Active" = '."'1'".' THEN '."'Active'".' WHEN "B_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblCOM_BuyerClass.DateCreated ASC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_BuyerClass",false));
		//echo $this->db->last_query();
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						        'count'=> $this->record_count("tblCOM_BuyerClass"),
					  	      'data' => $result->result_array());
		}else{
			return FALSE;
		}

  }
  
  public function add_data($data){

  	$buyers = $data['BS_FK_User_id'];
  	unset($data['BS_FK_User_id']);

  	$this->db->trans_start();
  	$this->db->insert('tblCOM_BuyerClass',add_data($data));
  	foreach ($buyers as $key => $value) {
  			$this->db->insert('tblCOM_BuyerSetup',array('BS_FK_User_id'=>$value,'BS_FK_BuyerClass_id'=>$data['B_Id']));
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
  			 ->update('tblCOM_BuyerClass',update_data($data['user']));

  
  	foreach ($data['delete'] as $key => $value) {
  		$this->db->where(array('md5("BS_FK_BuyerClass_id")' => $where['md5("B_Id")']))
  				 ->where(array('BS_FK_User_id' => $value))
  				 ->delete("tblCOM_BuyerSetup");

  	}

  	foreach ($data['add'] as $key => $value) {
  		$this->db->insert("tblCOM_BuyerSetup",array('BS_FK_User_id' => $value,'BS_FK_BuyerClass_id' => $data['user']['B_Id']));
  	}
  	
  	$this->db->trans_complete();
  	
  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

  public function get_spec_location_array($where){

    $result = $this->db->select(array('BS_FK_User_id'))
                       ->where($where)
                       ->get("tblCOM_BuyerSetup");
      return $result->result_array();
  }

}
