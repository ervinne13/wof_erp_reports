<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preventive_maintenance_model extends MY_Model {

 	public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_PM");
    }
  	public function table_data($data){
			
		extract($data);

	    $this->db->select(array(
	    						"PM_DocNo",
	    						'DATE("PM_DocDate") as "PM_DocDate"',
	    						"PM_Company",
	    						"PM_CompletionRate",
	    						"PM_QualityRate",
	    						"PM_OtherConcern",
	    						"PM_Status",
	    						'md5("PM_DocNo") as "id"'))
	    		 
				 ->group_by("tblINV_PM.PM_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("PM_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("PM_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("PM_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("PM_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("PM_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("PM_CompletionRate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("PM_QualityRate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("PM_OtherConcern" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("PM_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblINV_PM.PM_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_PM",false));
		
			if($perPage !=='All'){
			$this->db->limit($perPage,$offset);
		}

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
				    		
 		 					 ->get("tblINV_PM");

	    return $result->row_array()['count'];
  	}
	public function update_dismantle($where,$data){

	  		$details  = $data['details'];
	  		unset($data['details']);
	  		
	  		$this->db->trans_begin();

	  		$this->db->where($where)
	  				 ->update('tblINV_PM',$data);

	  		$this->db->where(array('md5("PMD_PM_DocNo")' => $where['md5("PM_DocNo"::text)']))
	  				 ->delete('tblINV_PMDetail');

	  		if($details){
		  		foreach ($details as $key => $value) {
					$value = array_filter($value);
					$value = array_diff($value, array(0));
					if(!empty($value) && is_array($value)){
			  			$value['PMD_PM_DocNo'] = $data['PM_DocNo'];
			  			$this->db->insert('tblINV_PMDetail',add_data($value));
			  		
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
