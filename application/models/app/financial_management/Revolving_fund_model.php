<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revolving_fund_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_RFV");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("RFV_DocNo",
	    						'DATE("RFV_DocDate") as "RFV_DocDate"',
	    						"RFV_TransDescription",
	    						"RFV_AmountRequested",
	    						"RFV_AmountReleased",
	    						"RFV_ActualAmountUsed",
	    						"RFV_Excess",
	    						'DATE("RFV_DateReleased") as "RFV_DateReleased"',
	    						'DATE("RFV_LiquidationDate") as "RFV_LiquidationDate"',
	    						"RFV_LiquidationStatus",
	    						"RFV_RequestStatus",
	    						'md5("RFV_DocNo") as "id"'))
	    		 ->group_start()
	    		 ->where_in('RFV_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    		 ->or_where('RFV_RequestStatus','Cancelled')
	    		 ->or_where('RFV_RequestStatus',NULL)
	    		 ->group_end()
				 ->group_by("tblACC_RFV.RFV_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("RFV_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("RFV_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("RFV_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_TransDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_AmountRequested" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_AmountReleased" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_ActualAmountUsed" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_Excess" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_LiquidationStatus" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RFV_RequestStatus" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
			$this->db->group_end();
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_RFV.RFV_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_RFV",false));
		
		if($perPage !=='All'){
			$this->db->limit($perPage,$offset);
		}

		$result = $this->db->query($this->db->get_compiled_select());

		// print_r($this->db->error());
		// print_r($this->db->last_query());
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
					  		  ->where_in('RFV_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
				    		 ->or_where('RFV_RequestStatus','Cancel')
				    		 ->or_where('RFV_RequestStatus',NULL)
 		 					 ->get("tblACC_RFV");

	    return $result->row_array()['count'];
  	}

  	public function update_rfv($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);

  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblACC_RFV',$data);

  		$this->db->where(array('md5("RFVD_PFK_DocNo")' => $where['md5("RFV_DocNo"::text)']))
  				 ->delete('tblACC_RFVDetail');

  		$this->db->where(array('md5("RFVDC_FK_DocNo")' => $where['md5("RFV_DocNo"::text)']))
  				 ->delete('tblACC_RFVDChargeTo');
  		$header = array();

  		if($details){

  			$header['RFV_ActualAmountUsed'] = array_sum(array_column($details,'RFVD_Amount'));
  			$header['RFV_Excess'] 		    = $data['RFV_AmountReleased'] - $header['RFV_ActualAmountUsed'];

	  		foreach ($details as $key => $value) {
	  			$chargeTo = $value['Charge'];
	  			unset( $value['Charge']);
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
		  			$value['RFVD_PFK_DocNo'] = $data['RFV_DocNo'];
		  			$value['RFVD_withVAT'] = $value['RFVD_withVAT'] ? 'TRUE' : 'FALSE';
		  			$this->db->insert('tblACC_RFVDetail',add_data($value));
		  			$insert_id = $this->db->insert_id();

		  			if(is_array($chargeTo) && count($chargeTo) != 0){

			  			foreach ($chargeTo as $ckey => $cvalue) {

			  				$chargeToDetails = array();
			  				$chargeToDetails['RFVDC_FK_LineNo'] 	= $insert_id;
			  				$chargeToDetails['RFVDC_FK_DocNo'] 		= $data['RFV_DocNo'];
			  				$chargeToDetails['RFVDC_Location'] 		= $cvalue['loc'];
			  				$chargeToDetails['RFVDC_Percentage'] 	= $cvalue['perc'];
			  				$chargeToDetails['RFVDC_Amount']  		= $cvalue['amount'];
			  
			  				$this->db->insert('tblACC_RFVDChargeTo',$chargeToDetails);
			  			}
		  			
		  			}
		  		}
	  		}
  		}

  		$this->db->where($where)
  				 ->update('tblACC_RFV',$header);

		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
        	$this->db->trans_commit();
            return 1;
        }
  	}

}
