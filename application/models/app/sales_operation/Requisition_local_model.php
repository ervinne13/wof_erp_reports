<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requisition_local_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_RQL");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("RQL_DocNo",
	    						'DATE("RQL_DocDate") as "RQL_DocDate"',
	    						"RQL_Remarks",
	    						"RQL_Requestor",
	    						// "RQL_Status",
	    						'md5("RQL_DocNo") as "id"'))
	    		 ->group_start()
	    		 ->where_in('RQL_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    		 ->or_where('RQL_Location',null)
	    		 ->group_end()
				 ->group_by("tblINV_RQL.RQL_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("RQL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("RQL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("RQL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQL_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQL_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQL_Requestor" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RQL_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
			$this->db->group_end();
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}
		else{
			$this->db->order_by(' CASE "RQL_Status"
								      WHEN '."'Open'".' THEN 1
								      WHEN '."'Pending'".' THEN 2
								      WHEN '."'Approved'".' THEN 3
								      ELSE 4 
								   END');
		}
		
		$count = $this->db->query($this->db->get_compiled_select("tblINV_RQL",false));
		
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
					  		 ->where_in('RQL_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
 		 					 ->or_where('RQL_Location',null)
 		 					 ->get("tblINV_RQL");

	    return $result->row_array()['count'];
  	}

  	public function update_rql($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);

  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblINV_RQL',$data);
  				 
  		$this->db->where(array('md5("RQLD_RQ_DocNo")' => $where['md5("RQL_DocNo"::text)']))
  				 ->delete('tblINV_RQLDetail');

  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
		  			$value['RQLD_RQ_DocNo'] = $data['RQL_DocNo'];
		  			$value['RQLD_Status']   = 'Open';
		  			$this->db->insert('tblINV_RQLDetail',add_data($value));
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
