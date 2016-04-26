<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amortization_loan_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_AMLHeader");
    }
  public function table_data($data){

	    extract($data);

	    $this->db->select(array("*",
	    						'DATE("AMLH_DocDate") as "AMLH_DocDate"',
	    						'md5("AMLH_DocNo") as id',
	    						'"BA_BankName" as "BankAccount"',)) 
	    		 ->join('tblACC_BankAccount','BA_BankID = AMLH_BankAccount','left')
				 ->group_by("tblACC_AMLHeader.AMLH_DocNo,BA_BankID");

		if(isset($queries['search'])){
			$this->db->group_start();
						
			$this->db->where(array('LOWER(CAST("AMLH_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMLH_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("BA_BankName" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMLH_LoanAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMLH_RunningBalance" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMLH_CostCenter" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
			$this->db->group_end();
		}

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("AMLH_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("AMLH_DocDate") <=' => $queries['date-to']));
		}
		
		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_AMLHeader.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_AMLHeader",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_AMLHeader"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

  public function process_amloan($where,$data){

    	$this->db->where($where)
                 ->update("tblACC_AMLHeader",update_data($data));

        $this->insert_loan($data);
    }

  public function insert_loan($data){

  $this->db->where(array('AMLD_FK_DocNo' => $data['AMLH_DocNo']))
    	   ->delete('tblACC_AMLDetail');

  $detail = array('AMLD_FK_DocNo'           => $data['AMLH_DocNo'],
        				'AMLD_Principal'    => $data['AMLH_LoanAmount'],
        				'AMLD_Interest'	    => $data['AMLH_LoanAmount'] * ($data['AMLH_AnnualInterestRate'] / 100));

	$this->db->insert("tblACC_AMLDetail",add_data($detail));
  }
}
