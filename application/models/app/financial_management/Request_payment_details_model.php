<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_payment_details_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_RPDetails");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array("*",'MD5(CONCAT("RPD_PFK_DocNo","RPD_LineNo")) as id'))
				 
				 ->group_by("RPD_PFK_DocNo,RPD_LineNo");
		
		if(isset($id)){
			$this->db->where(array('MD5("RPD_PFK_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("RPD_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_UnitPrice" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_AmountLCY" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_ExchangeRate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_RefTo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_CPC" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_VAT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RPD_WHT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_RPDetails.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_RPDetails",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		//$result = $this->db->get("tblCOM_Module");

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
  						  ->where(array('MD5("RPD_PFK_DocNo")'=>$this->id))
	    		 		 ->get("tblACC_RPDetails");

	    return $result->row_array()['count'];
   }

   public function get_spec_data_array_spec_fields_per_supplier($fields,$where){
   		$result =   $this->db->select($fields)
                             ->join('tblACC_RPHeader','RPH_DocNo = RPD_PFK_DocNo','left')
                             ->join('tblCOM_AttributeDetail','RPH_Currency = AD_Id','left')
                             ->join('tblINV_StoreProfile','RPH_Location = SP_StoreID','left')
                             ->where($where)
                             ->get("tblACC_RPDetails");
                             
        return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());
   }

}
