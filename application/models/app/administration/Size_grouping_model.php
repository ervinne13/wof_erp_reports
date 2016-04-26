<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Size_grouping_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("SS_Id",
	    						'MD5("SS_Id") as id',
	    						"a.AD_Desc as sizecat",
	    						// "b.AD_Desc as size",
	    						"SS_Seq",
								'(CASE WHEN "SS_Active" = '."'1'".' THEN '."'Active'".' WHEN "SS_Active" = '."'0'".' THEN '."'Inactive'".' END) as "SS_Active"'))
				 ->join('tblCOM_AttributeDetail as a','a.AD_Code = tblINV_SizeSet.SS_FK_SizeCat_id AND a.AD_FK_Code = '."'32'".'','left')
				 // ->join('tblCOM_AttributeDetail as b','b.AD_Code = tblINV_SizeSet.SS_FK_Size_id','left')
				 ->group_by("tblINV_SizeSet.SS_Id,a.AD_Code,a.AD_FK_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("SS_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										// 'LOWER(CAST("b"."AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SS_Seq" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "SS_Active" = '."'1'".' THEN '."'Active'".' WHEN "SS_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblINV_SizeSet.DateCreated DESC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_SizeSet",false));
		
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
  
  public function record_count(){
  	$result =	$this->db->select('COUNT(*)')
	    		 		 ->get("tblINV_SizeSet");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
   							 ->where(array('SS_Active' => '1'))
	    		 			 ->get("tblINV_SizeSet");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data($where){

		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblINV_SizeSet");

	    return $result->row_array();
  }

  public function add_data($data){

  	$this->db->insert('tblINV_SizeSet',add_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->where($where)
  			 ->update('tblINV_SizeSet',update_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblINV_SizeSet');

  	if($this->db->error()['code']==00000){
  		if($this->db->affected_rows() > 0){
  			return 1;
	  	}else{
	  		return 0;
	  	}
  	}else{
  		die($this->db_errors->error($this->db->error()['code']));
  	}

  }

}
