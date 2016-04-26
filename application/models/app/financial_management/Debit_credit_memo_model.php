<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debit_credit_memo_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("DC_DocNo") as id',
								'(CASE WHEN "DC_Active" = '."'1'".' THEN '."'Active'".' WHEN "DC_Active" = '."'0'".' THEN '."'Inactive'".' END) as "DC_Active"'))
				 ->group_by("tblACC_DebitCreditMemo.DC_DocNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("DC_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DC_AccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DC_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DC_DateRequired" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DC_ExtDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DC_Document_status" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "DC_Active" = '."'1'".' THEN '."'Active'".' WHEN "DC_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblACC_DebitCreditMemo.DC_DocNo ASC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_DebitCreditMemo",false));
		
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
		    		 		 ->get("tblACC_DebitCreditMemo");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
   							 ->where(array('DC_Active' => '1'))
	    		 			 ->get("tblACC_DebitCreditMemo");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data($where){

		$result =	$this->db->select(array('*',
									 	 	'md5("DC_DocNo") as id'))
	 						 ->where($where)
	 						 ->get("tblACC_DebitCreditMemo");

	    return $result->row_array();
  }

  public function add_data($data){

	  	$this->db->insert('tblACC_DebitCreditMemo',add_data($data));
	  	

	  	if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}
  }
	
  public function update_data($where,$data){
	
		$this->db->where($where)
	  			 ->update('tblACC_DebitCreditMemo',update_data($data));

	  	if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}

  	}

  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblACC_DebitCreditMemo');

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
