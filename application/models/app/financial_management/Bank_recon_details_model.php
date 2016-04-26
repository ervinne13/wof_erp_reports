<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_recon_details_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_BankReconDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array('to_char("BRD_TransDate", \'mm/dd/yyyy\') as "BRD_TransDate" ',
								'BRD_RefNo',
								'BRD_Payee',
								'BRD_CheckNo',
								'BRD_Particulars',
								'BRD_Debit',
								'BRD_Credit'
								))
				 
				 ->group_by("BRD_BR_DocNo,BRD_LineNo");
		
		if(isset($id)){
			$this->db->where(array('MD5("BRD_BR_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("BRD_TransDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BRD_RefNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BRD_Payee" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BRD_CheckNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BRD_Particulars" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("BRD_Credit" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_BankReconDetail.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_BankReconDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		// $result = $this->db->get("tblCOM_Module");
		// print_r($this->db->error());
		// exit();

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
  						  ->where(array('MD5("BRD_BR_DocNo")'=>$this->id))
	    		 		 ->get("tblACC_BankReconDetail");

	    return $result->row_array()['count'];
   }

}
