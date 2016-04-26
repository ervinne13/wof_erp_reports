<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_voucher_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_CVDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array("*",'MD5(CONCAT("CVD_PFK_DocNo","CVD_LineNo")) as id'))
				 ->where(array('MD5("CVD_PFK_DocNo")'=>$id))
				 ->group_by("CVD_PFK_DocNo,CVD_LineNo");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CVD_RefDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CVD_RefDocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CVD_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CVD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CVD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_CVDetail.DateCreated DESC');
		}
			
		$this->id = $id;
		$count = $this->db->query($this->db->get_compiled_select("tblACC_CVDetail",false));
		
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
  						  ->where(array('MD5("CVD_PFK_DocNo")'=>$this->id))
	    		 		 ->get("tblACC_CVDetail");

	    return $result->row_array()['count'];
   }

   public function convert($data){
   	$apvupdate = array();
   	foreach ($data as $key => $value) {
   		$this->add_data((array) $value);
   	}

   	if($this->db->affected_rows()>0){
   		return 1;
   	}else{
   		return 0;
   	}
   }

}
