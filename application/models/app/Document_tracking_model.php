<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_tracking_model extends MY_Model {
  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_DocTracking");
    }

  public function table_data($data,$id){
		
		extract($data);

	    $this->db->select(array('*',
	    						'"P_Position" as "Position"',
	    						"COALESCE(".'"DT_ApprovedBy"::text'.",'') as  ".'"ApprovedBy"'." ",
	    						"COALESCE(".'"DT_DateApproved"::text'.",'') as  ".'"DateApproved"'." ",
	    						))
	    		 ->join('tblCOM_Position','tblCOM_Position.P_Position_id = tblCOM_DocTracking.DT_Approver','left')
	    		 ->where(array('md5("DT_DocNo")' => $id))
				 ->group_by("tblCOM_DocTracking.DT_EntryNo,P_Position_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("DT_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DT_Sender" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("P_Position" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DT_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DT_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DT_EntryDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DT_ApprovedBy" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("DT_DateApproved" as text)) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblCOM_DocTracking.DT_EntryNo ASC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_DocTracking",false));
		
		if(isset($perPage)&&isset($offset)){
			$this->db->limit($perPage,$offset);
		}

		$result = $this->db->query($this->db->get_compiled_select());
		$this->id = $id;
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
        $result =   $this->db->select('COUNT(*)')
        				 ->where(array('md5("DT_DocNo")' => $this->id))
                         ->get("tblCOM_DocTracking");

        return $result->row_array()['count'];
    }
}
