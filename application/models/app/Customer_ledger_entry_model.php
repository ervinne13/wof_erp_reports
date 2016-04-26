<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_ledger_entry_model extends MY_Model {
  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_CustomerLedger");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('*',
	    						))
	    		 ->where(array('md5("CL_CustomerID")' => $id))
				 ->group_by("tblCOM_CustomerLedger.CL_EntryNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_DocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_DocAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_CustomerID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_CustomerName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_ExtDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_CustomerPostingGroup" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_PaymentTerms" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_DueDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_CPC" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_BalAccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_BalAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_BalAccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_AppliesToDocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_AppliesToDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_AppliesToDocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_AppliesToID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_AppliedAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_WHTAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_VATAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_RemAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_PostedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CL_DatePosted" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										isset($queries['customer-filer']) ? '"' .$queries['customer-filer'].'"' . ' LIKE' : 'LOWER(CAST("CL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('DATE("CL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('DATE("CL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblCOM_CustomerLedger.CL_EntryNo ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_CustomerLedger",false));
		
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
        				 ->where(array('md5("CL_CustomerID")' => $this->id))
                         ->get("tblCOM_CustomerLedger");

        return $result->row_array()['count'];
    }
}
