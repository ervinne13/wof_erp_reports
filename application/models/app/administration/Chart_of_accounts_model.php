<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart_of_accounts_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("CA_Account_id") as id',
								'(CASE WHEN "CA_Active" = '."'1'".' THEN '."'Active'".' WHEN "CA_Active" = '."'0'".' THEN '."'Inactive'".' END) as "CA_Active"'))
				 ->group_by("tblACC_ChartAccount.CA_Account_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CA_Account_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CA_AccountDesc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CA_BookType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "CA_Active" = '."'1'".' THEN '."'Active'".' WHEN "CA_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_ChartAccount.DateCreated DESC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_ChartAccount",false));
		
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
	    		 		 ->get("tblACC_ChartAccount");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
   							 ->where(array('CA_Active' => '1'))
	    		 			 ->get("tblACC_ChartAccount");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data($where){

		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblACC_ChartAccount");

	    return $result->row_array();
  }

  public function add_data($data){

  	$this->db->insert('tblACC_ChartAccount',add_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->where($where)
  			 ->update('tblACC_ChartAccount',update_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
  
  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblACC_ChartAccount');

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

}
