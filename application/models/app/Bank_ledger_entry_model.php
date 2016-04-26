<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_ledger_entry_model extends MY_Model {
  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_BankAccountLedger");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('*',
	    						))
	    		 ->where(array('md5("BAL_BankAccountNo")' => $id))
				 ->group_by("tblACC_BankAccountLedger.BAL_EntryNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(

										'LOWER(CAST("BAL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_DocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_BankAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_BankAccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_Debit" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_Credit" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_Currency" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_AmountLCY" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_BalAccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_BalAccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_BalAccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_CPC" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_DatePosted" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_PostedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BAL_DateCreated" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										isset($queries['general-filer']) ? '"' .$queries['general-filer'].'"' . ' LIKE' : 'LOWER(CAST("BAL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('DATE("BAL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('DATE("BAL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_BankAccountLedger.BAL_EntryNo ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_BankAccountLedger",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());
		$this->id = $id;
		

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count(),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  	}

  	public function record_count(){
        $result =   $this->db->select('COUNT(*)')
        				 ->where(array('md5("BAL_BankAccountNo")' => $this->id))
                         ->get("tblACC_BankAccountLedger");

        return $result->row_array()['count'];
    }
}
