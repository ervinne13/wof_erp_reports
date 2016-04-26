<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_local_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_POLDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array('POLD_PO_DocNo',
								'POLD_ItemType',
								'POLD_ItemNo',
								'POLD_ItemDescription',
								'POLD_Location',
								'POLD_Qty',
								'POLD_UOM',
								'POLD_UnitPrice',
								'POLD_Total',
								'POLD_Comment',								
								'md5(concat("POLD_PO_DocNo","POLD_LineNo")) as id'))
				 ->join('tblINV_ItemType','IT_Id = POLD_ItemType','left')
				 ->group_by("POLD_PO_DocNo,POLD_LineNo,IT_Id");		
		if(isset($id)){
			$this->db->where(array('MD5("POLD_PO_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("POLD_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_UOM" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_UnitPrice" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("POLD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblCOM_POLDetail.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_POLDetail",false));
		
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
  						  ->where(array('MD5("POLD_PO_DocNo")'=>$this->id))
	    		 		 ->get("tblCOM_POLDetail");

	    return $result->row_array()['count'];
   }

}
