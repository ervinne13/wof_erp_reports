<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Bank_accounts_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_BankAccount");
    }

  public function table_data($data){
	
	   extract($data);

	    $this->db->select(array("*",
	    						'md5("BA_BankID") as id',))
	    						
				 ->group_by("tblACC_BankAccount.BA_BankID");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("BA_BankID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BA_BankName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BA_BankAccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BA_BankAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BA_BankAddress" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BA_BookBalance" as text)) LIKE' => '%'.strtolower($queries['search']).'%',							
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
			$this->db->order_by('tblACC_BankAccount.DateCreated ASC');
		}
		$count = $this->db->query($this->db->get_compiled_select("tblACC_BankAccount",false));
		
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

  	 public function get_spec_data_row_spec_fields($fields,$where=array(),$join=array()){

        $result =   $this->db->select($fields)
                             ->join('tblACC_ChartAccount','COA_Account_id = BA_GLAccount','left')
                             ->where($where)
                             ->get('tblACC_BankAccount');  
                             
        return $result->row_array();                                    
    }

   public function get_bookbal($where){

    	$result = $this->db->select('SUM("BAL_Amount") as total')

	 						 ->get("tblACC_BankAccountLedger");

	 	return $result->row_array();
    }

}
