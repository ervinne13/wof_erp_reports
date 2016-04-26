<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preventive_maintenance_detail_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_PMDetail");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array(
	    						"PMD_PM_DocNo",
	    						"PMD_AssetID",
	    						"PMD_ItemNo",
	    						"PMD_MachineName",
	    						"PMD_PMSched",
	    						"PMD_PreviousFindings",
	    						"PMD_BTActualPMDate",
	    						'md5(concat("PMD_PM_DocNo","PMD_LineNo")) as "id"'))

				 ->group_by("tblINV_PMDetail.PMD_PM_DocNo,PMD_LineNo");

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(		'LOWER(CAST("PMD_PM_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PMD_AssetID" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PMD_ItemNos" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PMD_MachineName" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PMD_PMSched" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PMD_PreviousFindings" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PMD_BTActualPMDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblINV_PMDetail.PMD_PM_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_PMDetail",false));
		
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
				    		
 		 					 ->get("tblINV_PMDetail");

	    return $result->row_array()['count'];
  	}

  	public function get_assetid_total_actauldate(){
		$result =	$this->db->select('COUNT("PMD_AssetID") as Count')
							 ->where('PMD_BTActualPMDate' != null)
 		 					 ->get("tblINV_PMDetail");

	    return $result->row_array();
  	}

  	public function get_assetid_total(){
		$result =	$this->db->select('COUNT("PMD_AssetID") as Total')
 		 					 ->get("tblINV_PMDetail");

	    return $result->row_array();
  	}

}
