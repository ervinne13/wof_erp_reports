<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_voucher_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_CVHeader");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("CV_DocNo",
	    						'DATE("CV_DocDate") as "CV_DocDate"',
	    						"CV_ExtDocNo",
	    						"CV_SupplierName",
	    						"CV_PaymentTerms",
	    						'DATE("CV_DueDate") as "CV_DueDate"',
	    						"CV_CheckNo",
	    						"CV_CheckAmount",
	    						"CV_Released",
	    						"CV_Cleared",
	    						"CV_Bank",
	    						"CV_DateReleased",
	    						"CV_Status",
	    						'md5("CV_DocNo") as id'))
				 ->group_by("tblACC_CVHeader.CV_DocNo");

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array('LOWER(CAST("CV_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_ExtDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_SupplierName" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_PaymentTerms" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_DueDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_CheckNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_CheckAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_Bank" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("CV_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
			$this->db->group_end();
		}


		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("CV_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("CV_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_CVHeader.DateCreated DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_CVHeader",false));
		
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
 		 					 ->get("tblACC_CVHeader");

	    return $result->row_array()['count'];
  	} 	
}
