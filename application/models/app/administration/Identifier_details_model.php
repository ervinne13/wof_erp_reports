<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Identifier_details_model extends My_Model {

  private $id = NULL;
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_IdentifierDetails");
    }

   public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						' "SC_Description" as "subcat"', 
	    						'md5("IDD_Id"::text) as "id"', 
								'(CASE WHEN "IDD_Active" = '."'1'".' THEN '."'Active'".' WHEN "IDD_Active" = '."'0'".' THEN '."'Inactive'".' END) as "IDD_Active"'))
				 ->join('tblINV_SubCategory','SC_Id = tblINV_IdentifierDetails.IDD_FK_SubCategory_id','left')
				 ->where(array('MD5("IDD_FK_Identifier_id")'=>$id))
				 ->group_by("tblINV_IdentifierDetails.IDD_Id,SC_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("IDD_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SC_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "IDD_Active" = '."'1'".' THEN '."'Active'".' WHEN "IDD_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblINV_IdentifierDetails.DateCreated DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_IdentifierDetails",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		//$result = $this->db->get("tblCOM_Module");
		$this->id = $id;
		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count($id),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
  public function record_count(){
  		$result =	$this->db->select('COUNT(*)')
	    		 		 ->where(array('IDD_FK_Identifier_id' => $this->id))
	    		 		 ->get("tblINV_IdentifierDetails");

	    return $result->row_array()['count'];
   }

  public function get_spec_data($where){

		$result =	$this->db->select(array('*','md5("IDD_FK_Identifier_id") as id','md5("IDD_Id"::text) as mid'))
	 						 ->where($where)
	 						 ->get("tblINV_IdentifierDetails");

	    return $result->row_array();
  }	

}
