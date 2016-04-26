<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requisition_model
  extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_RQ");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("RQ_DocNo",
	    						'DATE("RQ_DocDate") as "RQ_DocDate"',
	    						"RQ_Remarks",
	    						'DATE("RQ_DateNeeded") as "RQ_DateNeeded"',
	    						"RQ_Purpose",
	    						"RQ_Location",
	    						"RQ_Company",
	    						"RQ_TotalAmount",
	    						'md5("RQ_DocNo") as "id"'))
	    		 ->group_start()
	    		 ->where_in('RQ_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    		 ->or_where('RQ_Location',null)
	    		 ->group_end()
				 ->group_by("tblINV_RQ.RQ_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("RQ_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("RQ_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("RQ_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQ_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQ_Purpose" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQ_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQ_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQ_TotalAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblINV_RQ.RQ_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_RQ",false));
		
		if($perPage !=='All'){
			$this->db->limit($perPage,$offset);
		}

		// print_r($this->db->error());
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
					  		 ->where_in('RQ_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
 		 					 ->or_where('RQ_Location',null)
 		 					 ->get("tblINV_RQ");

	    return $result->row_array()['count'];
  	}

  	public function update_rq($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);

  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblINV_RQ',$data);

  		$this->db->where(array('md5("RQD_RQ_DocNo")' => $where['md5("RQ_DocNo"::text)']))
  				 ->delete('tblINV_RQDetail');

  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
					unset($value['RQD_RemainingQty']);
		  			$value['RQD_RQ_DocNo'] = $data['RQ_DocNo'];
		  			$value['RQD_Status']   = 'Open';
		  			$this->db->insert('tblINV_RQDetail',add_data($value));
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
