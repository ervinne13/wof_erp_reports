<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revolving_fund_replenishment_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_Replenishment");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("RFR_DocNo",
	    						'DATE("RFR_DocDate") as "RFR_DocDate"',
	    						"RFR_SourceOfFund",
	    						"RFR_PeriodFrom",
	    						"RFR_PeriodTo",
	    						"RFR_FundCustodian",
	    						"RFR_Status",
	    						'RFR_ActualAmount',
	    						'md5("RFR_DocNo") as "id"'))
	    		 ->group_start()
	    		 ->where_in('RFR_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    		 ->or_where('RFR_Status','Cancelled')
	    		 ->or_where('RFR_Status',NULL)
	    		 ->group_end()
				 ->group_by("tblCOM_Replenishment.RFR_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("RFR_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("RFR_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("RFR_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("RFR_SourceOfFund" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("RFR_PeriodFrom" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("RFR_PeriodTo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("RFR_FundCustodian" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("RFR_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("RFR_ActualAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblCOM_Replenishment.RFR_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_Replenishment",false));
		
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
					  		  ->where_in('RFR_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
				    		 ->or_where('RFR_Status','Cancel')
				    		 ->or_where('RFR_Status',NULL)
 		 					 ->get("tblCOM_Replenishment");

	    return $result->row_array()['count'];
  	}

  	public function update_rfr($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);
  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblCOM_Replenishment',$data);
  		
  		$this->db->where(array('md5("RFRD_PFK_DocNo")' => $where['md5("RFR_DocNo"::text)']))
  				 ->delete('tblCOM_ReplenishmentDetail');
  				 
  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
		  			$value['RFRD_PFK_DocNo'] = $data['RFR_DocNo'];
		  			$this->db->insert('tblCOM_ReplenishmentDetail',add_data($value));
		  		}
	  		}
  		}
  		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
        	$this->db->trans_commit();
            return 1;
        }
  	}

}
