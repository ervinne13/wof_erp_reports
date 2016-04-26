<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_PODetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array("*"))
				 
				 ->group_by("POD_PO_DocNo,POD_LineNo");
		
		if(isset($id)){
			$this->db->where(array('MD5("POD_PO_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("POD_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_UOM" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_UnitPrice" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_Total" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_RefFrom" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_EstimatedCost" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_VAT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POD_WHT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblCOM_PODetail.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_PODetail",false));
		
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
  						  ->where(array('MD5("POD_PO_DocNo")'=>$this->id))
	    		 		 ->get("tblCOM_PODetail");

	    return $result->row_array()['count'];
   }

}
