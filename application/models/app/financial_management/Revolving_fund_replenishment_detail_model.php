<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revolving_fund_replenishment_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_ReplenishmentDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array('to_char("RFRD_Date", \'mm/dd/yyyy\') as "RFRD_Date" ',
								'RFRD_RefDocNo',
								'RFRD_Requestor',
								'RFRD_Description',
								'RFRD_ActualAmount'))
				 
				 ->group_by("RFRD_PFK_DocNo,RFRD_LineNo");
		
		if(isset($id)){
			$this->db->where(array('MD5("RFRD_PFK_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("RFRD_Date" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFRD_RefDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFRD_Requestor" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFRD_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RFRD_ActualAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblCOM_ReplenishmentDetail.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_ReplenishmentDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		//$result = $this->db->get("tblCOM_Module");
		// print_r($this->db->error());
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
  						  ->where(array('MD5("RFRD_PFK_DocNo")'=>$this->id))
	    		 		 ->get("tblCOM_ReplenishmentDetail");

	    return $result->row_array()['count'];
   }

}
