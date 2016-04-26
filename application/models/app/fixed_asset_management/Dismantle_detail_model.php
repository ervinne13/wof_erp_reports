<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dismantle_detail_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_ADMDetail");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array(
	    						"ADMD_ADM_DocNo",
	    						"ADMD_AssetID",
	    						"ADMD_MachineClass",
	    						"ADMD_ItemNo",
	    						"ADMD_BookValue",
	    						"ADMD_Justification",
	    						"ADMD_ItemDescription",
	    						'md5(concat("ADMD_ADM_DocNo","ADMD_LineNo")) as "id"'))

				 ->group_by("ADMD_ADM_DocNo,ADMD_LineNo");
			if(isset($id)){
			$this->db->where(array('MD5("ADMD_ADM_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("ADMD_ADM_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADMD_AssetID" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADMD_MachineClass" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADMD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADMD_BookValue" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADMD_Justification" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("ADMD_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblINV_ADMDetail.ADMD_ADM_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_ADMDetail",false));
		
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
				    		
 		 					 ->get("tblINV_ADMDetail");

	    return $result->row_array()['count'];
  	}


  	 public function get_total_amount(){

    	$result = $this->db->select('SUM("ADMD_BookValue") as total')
	 						 ->group_by('ADMD_ADM_DocNo')
	 						 ->get("tblINV_ADMDetail"); 

	 	// print_r($result);
	 	// exit();

	 	return $result->row_array();
    }

}
