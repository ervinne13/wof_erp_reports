<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_recon_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_BankRecon");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array(
	    						"BR_DocNo",
	    						'DATE("BR_DocDate") as "BR_DocDate"',
	    						"BR_BankAccountNo",
	    						"BR_StatementNo",
	    						"BR_StatementDate",
	    						"BR_Period",
	    						"BR_Status",
	    						'md5("BR_DocNo") as "id"'))
	    		 
				 ->group_by("tblACC_BankRecon.BR_DocNo");

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(		'LOWER(CAST("BR_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("BR_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("BR_BankAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("BR_StatementNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("BR_StatementDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("BR_Period" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("BR_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
			$this->db->group_end();
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_BankRecon.BR_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_BankRecon",false));
		
			if($perPage !=='All'){
			$this->db->limit($perPage,$offset);
		}

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
				    		
 		 					 ->get("tblACC_BankRecon");

	    return $result->row_array()['count'];
  	}

  	public function update_bankrecon($where,$data){

  		$details  = $data['details'];
  		unset($data['details']);
  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblACC_BankRecon',$data);

  		$this->db->where(array('md5("BRD_BR_DocNo")' => $where['md5("BR_DocNo"::text)']))
  				 ->delete('tblACC_BankReconDetail');

  		if($details){
	  		foreach ($details as $key => $value) {
				$value = array_filter($value);
				$value = array_diff($value, array(0));
				if(!empty($value) && is_array($value)){
		  			$value['BRD_BR_DocNo'] = $data['BR_DocNo'];
		  			$this->db->insert('tblACC_BankReconDetail',add_data($value));
		  		
		  		}
	  		}
  		}
  		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
        	$this->db->trans_commit();
            return 1;
        }
  	}

  	 public function get_endbal(){

    	$result = $this->db->select('SUM("BAL_Amount") as total') 
    					   ->where(array('BAL_BankAccountNo' => $data['BRD_BankAccountNo']))
	 					   ->get("tblACC_BankAccountLedger");	 
	 	return $result->row_array();
    }

}
