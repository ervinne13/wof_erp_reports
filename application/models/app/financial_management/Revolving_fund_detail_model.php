<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revolving_fund_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_RFVDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array("*"))
				 
				 ->group_by("RFVD_PFK_DocNo,RFVD_LineNo");
		
		if(isset($id)){
			$this->db->where(array('MD5("RFVD_PFK_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("RFVD_TransDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_InvOR" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_Payee" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_Address" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_TinNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_withVAT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_Particular" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_VAT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_NetOfVat" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFVD_ChargeTo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_RFVDetail.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_RFVDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		//$result = $this->db->get("tblCOM_Module");
		// print_r($this->db->error());
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
  						  ->where(array('MD5("RFVD_PFK_DocNo")'=>$this->id))
	    		 		 ->get("tblACC_RFVDetail");

	    return $result->row_array()['count'];
   }

}
