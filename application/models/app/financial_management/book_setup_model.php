<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_setup_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_BookType");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("BT_BookID",
	    						'md5("BT_BookID") as "id" ',
	    						"BT_BookName",
	    						'(CASE WHEN "BT_Active" = '."'1'".' THEN '."'Active'".' WHEN "BT_Active" = '."'0'".' THEN '."'Inactive'".' END) as "BT_Active"'))
				 ->group_by("BT_BookID");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("BT_BookID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BT_BookName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "BT_Active" = '."'1'".' THEN '."'Active'".' WHEN "BT_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_BookType.DateCreated ASC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblACC_BookType",false));
		//echo $this->db->last_query();
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_BookType"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}

  }

  public function add_data($data){

  	$module = $data['BS_FK_Module_ID'];
  	unset($data['BS_FK_Module_ID']);

  	$this->db->trans_start();
  	$this->db->insert('tblACC_BookType',add_data($data));

  	foreach ($module as $key => $value) {
  			$this->db->insert('tblACC_BookSetup',array('BS_FK_Module_ID'=>$value,'BT_BookID'=>$data['BT_BookID']));
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
  			 ->update('tblACC_BookType',update_data($data['book']));

  
  	foreach ($data['delete'] as $key => $value) {
  		$this->db->where(array('md5("BT_BookID")' => $where['md5("BT_BookID")']))
  				 ->where(array('BS_FK_Module_ID' => $value))
  				 ->delete("tblACC_BookSetup");

  	}

  	foreach ($data['add'] as $key => $value) {
  		$this->db->insert("tblACC_BookSetup",array('BS_FK_Module_ID' => $value,'BT_BookID' => $data['book']['BT_BookID']));
  	}
  	
  	$this->db->trans_complete();
  	
  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

   public function get_spec_module_array($where){

    $result = $this->db->select('*')
               ->where($where)
               ->get("tblACC_BookSetup");
    return $result->result_array();
  }

}
