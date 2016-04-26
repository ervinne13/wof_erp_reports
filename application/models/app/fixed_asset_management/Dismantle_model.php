<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dismantle_model extends MY_Model {

 	public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_ADM");
    }
  	public function table_data($data){
			
		extract($data);

	    $this->db->select(array(
	    						"ADM_DocNo",
	    						'DATE("ADM_DocDate") as "ADM_DocDate"',
	    						"ADM_RefNo",
	    						"ADM_Location",
	    						"ADM_Remarks",
	    						"ADM_Status",
	    						'md5("ADM_DocNo") as "id"'))
	    		 
				 ->group_by("tblINV_ADM.ADM_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("ADM_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("ADM_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(		'LOWER(CAST("ADM_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADM_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADM_RefNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADM_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADM_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADM_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblINV_ADM.ADM_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_ADM",false));
		
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
				    		
 		 					 ->get("tblINV_ADM");

	    return $result->row_array()['count'];
  	}
	public function update_dismantle($where,$data){

	  		$details  = $data['details'];
	  		unset($data['details']);
	  		
	  		$this->db->trans_begin();

	  		$this->db->where($where)
	  				 ->update('tblINV_ADM',$data);

	  		$this->db->where(array('md5("ADMD_ADM_DocNo")' => $where['md5("ADM_DocNo"::text)']))
	  				 ->delete('tblINV_ADMDetail');

	  		if($details){
		  		foreach ($details as $key => $value) {
					$value = array_filter($value);
					$value = array_diff($value, array(0));
					if(!empty($value) && is_array($value)){
			  			$value['ADMD_ADM_DocNo'] = $data['ADM_DocNo'];
			  			$this->db->insert('tblINV_ADMDetail',add_data($value));
			  		
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
