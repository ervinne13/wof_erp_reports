<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_ledger_entry_model extends MY_Model {
  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_SupplierLedger");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('*',
	    						))
	    		 ->where(array('md5("SL_SupplierID")' => $id))
				 ->group_by("tblCOM_SupplierLedger.SL_EntryNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(

										'LOWER(CAST("SL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DocAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DocAmountLCY" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_SupplierID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_SupplierName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_ExtDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_Currency" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_SupplierPostingGroup" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_PaymentTerms" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DueDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_Buyer" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_RequestedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_RefDocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_RefDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_RefDocAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_AppliesToDocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_AppliesToDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_AppliesToDocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_AppliesToID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_AppliedAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_RemAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_PostedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SL_DatePosted" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										isset($queries['supplier-filer']) ? '"' .$queries['supplier-filer'].'"' . ' LIKE' : 'LOWER(CAST("SL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('DATE("SL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('DATE("SL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblCOM_SupplierLedger.SL_EntryNo ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_SupplierLedger",false));
		
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
        				 ->where(array('md5("SL_SupplierID")' => $this->id))
                         ->get("tblCOM_SupplierLedger");

        return $result->row_array()['count'];
    }
}
