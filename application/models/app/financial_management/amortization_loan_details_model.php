<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amortization_loan_details_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

   public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("AMLD_LineNo"::text) as "id"',
	    						'"AMLH_CostCenter" as "CostCenter"',))
	    		 ->join('tblACC_AMLHeader','AMLH_DocNo = AMLD_FK_DocNo','left')	    		
	    		 ->where(array('MD5("AMLD_FK_DocNo")'=>$id))
				 ->group_by("tblACC_AMLDetail.AMLD_LineNo,AMLD_FK_DocNo,AMLH_DocNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("AMLD_PaymentDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_FK_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_PaymentDocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_PaymentAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_Principal" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_Interest" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_Penalty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMLD_RunningBalance" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_AMLDetail.DateCreated DESC');
		}
		
		$count = $this->db->query($this->db->get_compiled_select("tblACC_AMLDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count($id),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
  public function record_count($id){
  	$result =	$this->db->select('COUNT(*)')
	    		 		 ->where(array('AMLD_FK_DocNo' => $id))
	    		 		 ->get("tblACC_AMLDetail");

	    return $result->row_array()['count'];
   }

   public function process_details($data){
   		
   		$this->load->model('app/financial_management/amortization_loan_model');
   		$loan = array();
   		$loan['AMLD_PaymentAmount']  = 0;
   		$loan['AMLD_RunningBalance'] = 0;
      // echo "<pre>";
      // print_r($data);
     	foreach ($data as $key => $value) {
     		if(in_array($value['COA_AmortizationType'], array('2000','3000','4000'))){
   				$total = $this->amortization_loan_model->get_spec_data_row(array('AMLH_DocNo' => $value['AMLD_FK_DocNo']));
     			$loan['AMLD_PaymentDocNo']  = $value['AMLD_PaymentDocNo'];
     			$loan['AMLD_FK_DocNo']      = $value['AMLD_FK_DocNo'];
     			$loan['AMLD_PaymentDocDate']= $value['CV_DocDate'];

     			switch ($value['COA_AmortizationType']) {
     				case '2000':
     					$loan['AMLD_Principal'] 	      =  $value['amount'];
     					$loan['AMLD_PaymentAmount']     += $value['amount'];
     					$loan['AMLD_RunningBalance']    =  $total['AMLH_RunningBalance'] - $value['amount'];
     					break;
     				case '3000':
     					$loan['AMLD_Penalty'] 		    =  $value['amount'];
     					$loan['AMLD_PaymentAmount']   += $value['amount'];
     					break;
     				case '4000':
     					$loan['AMLD_Interest'] 		     =  $value['amount'];
     					$loan['AMLD_PaymentAmount']    += $value['amount'];
     					break;
     				
     			}
     		}

     	}

     	if(count($loan)>2){
			$this->add_data($loan);
     	}
     		

   }

    public function get_spec_data_array($where){

        $result =   $this->db->select(array('*'))
                             ->where($where)
                             ->get("tblACC_AMLDetail");
        return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());
    }


   public function get_spec_data($where){

		$result =	$this->db->select(array('*','md5("AMLD_FK_DocNo") as id','md5("AMLD_LineNo"::text) as mid'))
	 						 ->where($where)
	 						 ->get("tblACC_AMLDetail");
	    return $result->row_array();
  }

  public function add_data($data){

  	$this->db->insert('tblACC_AMLDetail',add_data($data));



  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->where($where)
  			 ->update('tblACC_AMLDetail',update_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblACC_AMLDetail');

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
  
  public function get_all_data($where){

   		$result =	$this->db->select('*')
   							 ->where($where)
	    		 			 ->get("tblACC_AMLDetail");

	    return array('rows' 	=> $result->num_rows(),
	    		 	 'data' 	=> $result->result_array());

  }

}
