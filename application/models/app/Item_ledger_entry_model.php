<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_ledger_entry_model extends MY_Model {
  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_ItemLedger");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('*',
	    						))
	    		 ->where(array('md5("IL_ItemNo")' => $id))
				 ->group_by("tblINV_ItemLedger.IL_EntryNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(

										'LOWER(CAST("IL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_AccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_AccountID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_DocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',

										'LOWER(CAST("IL_LineNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_RemQty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',

										'LOWER(CAST("IL_UnitPrice" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_AmountLCY" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_SubLocation" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_UOM" as text)) LIKE' => '%'.strtolower($queries['search']).'%',

										'LOWER(CAST("IL_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_CPC" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_VAT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_WHT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_PostedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IL_DatePosted" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										isset($queries['item-filer']) ? '"' .$queries['item-filer'].'"' . ' LIKE' : 'LOWER(CAST("IL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('DATE("IL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('DATE("IL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblINV_ItemLedger.IL_EntryNo ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_ItemLedger",false));
		
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
        				 ->where(array('md5("IL_ItemNo")' => $this->id))
                         ->get("tblINV_ItemLedger");

        return $result->row_array()['count'];
    }
}
