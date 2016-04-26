<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_posting_setup_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id")) as id',
	    						'"a"."PG_Description" as "Posting"',
	    						'"b"."CA_AccountName" as "Account"',
	    						'(CASE WHEN "AS_Active" = '."'1'".' THEN '."'Active'".' WHEN "AS_Active" = '."'0'".' THEN '."'Inactive'".' END) as "AS_Active"'))
				 ->join('tblACC_PostingGroup as a','a.PG_Id = tblACC_PostingAccountSetup.AS_PKFK_PostingGroup_id','left')
				 ->join('tblACC_ChartAccount b','b.CA_Account_id = tblACC_PostingAccountSetup.AS_PKFK_Account_id','left')
				 ->group_by("AS_PKFK_PostingGroup_id,AS_PKFK_Account_id,a.PG_Id,b.CA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("b"."LOC_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."U_User_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "AS_Active" = '."'1'".' THEN '."'Active'".' WHEN "AS_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_PostingAccountSetup.DateCreated DESC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_PostingAccountSetup",false));
		
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
	    		 		 ->get("tblACC_PostingAccountSetup");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
	    		 			 ->get("tblACC_PostingAccountSetup");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data($where){

		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblACC_PostingAccountSetup");

	    return $result->row_array();
  }

  public function add_data($data){

  	$this->db->insert('tblACC_PostingAccountSetup',add_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->where($where)
  			 ->update('tblACC_PostingAccountSetup',update_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblACC_PostingAccountSetup');

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

}
