<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_ledger_entry_model extends MY_Model {
  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_GLEntry");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('*',
	    						))
	    		 ->where(array('md5("GL_AccountID")' => $id))
				 ->group_by("tblACC_GLEntry.GL_EntryNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(

										'LOWER(CAST("GL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_DocType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_AccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_AccountID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_Debit" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_Credit" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_CPC" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_FK_BT_BookID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_BalAccountType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_BalAccountNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_BalAccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_PostedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_DatePosted" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_DateCreated" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("GL_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										isset($queries['general-filer']) ? '"' .$queries['general-filer'].'"' . ' LIKE' : 'LOWER(CAST("GL_EntryNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('DATE("GL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('DATE("GL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_GLEntry.GL_EntryNo ASC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_GLEntry",false));
		
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
        				 ->where(array('md5("GL_AccountID")' => $this->id))
                         ->get("tblACC_GLEntry");

        return $result->row_array()['count'];
    }
}
