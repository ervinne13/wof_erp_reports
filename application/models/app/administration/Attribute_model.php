<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute_model extends MY_Model {
  
  private $id = NULL;
  
  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_AttributeDetail");
    }

  public function table_data($data,$id){
		
		extract($data);

	    $this->db->select(array("AD_Code",
	    						'md5("AD_Code")||'."'-'".'||"AD_FK_Code" as id',
								"AD_Desc",
								'(CASE WHEN "AD_Active" = '."'1'".' THEN '."'Active'".' WHEN "AD_Active" = '."'0'".' THEN '."'Inactive'".' END) as "AD_Active"'))
	    		->join("tblCOM_Attribute","tblCOM_AttributeDetail.AD_FK_Code = tblCOM_Attribute.A_Code","left")
	    		->where(array('A_FK_Module_id' => $id))
				->group_by("tblCOM_AttributeDetail.AD_Code,AD_FK_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("AD_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "AD_Active" = '."'1'".' THEN '."'Active'".' WHEN "AD_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblCOM_AttributeDetail.DateCreated DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_AttributeDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

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
  	$result =	$this->db->select('COUNT(*) as count')
	    		 		 ->join("tblCOM_Attribute","tblCOM_AttributeDetail.AD_FK_Code = tblCOM_Attribute.A_Code","left")
			    		 ->where(array('A_FK_Module_id' => $this->id))
	    		 		 ->get("tblCOM_AttributeDetail");		 		 
	    return  $result->row_array()['count'];
   }

  public function get_spec_attribute($id){

  		$result =  $this->db->select('*')
							->join("tblCOM_Attribute","tblCOM_AttributeDetail.AD_FK_Code = tblCOM_Attribute.A_Code","left")
	    					->where(array('A_FK_Module_id' => $id))
							->group_by("tblCOM_AttributeDetail.AD_Code,AD_FK_Code")
 							->get("tblCOM_AttributeDetail");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

   public function get_spec_attribute_dropdown($id){

  		$result =  $this->db->select('*')
							->where(array('AD_FK_Code' => $id,'AD_Active' => '1'))
							->group_by("tblCOM_AttributeDetail.AD_Code,AD_FK_Code")
 							->get("tblCOM_AttributeDetail");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data_attribute($id){

  		return $this->db->select(array('*'))
						->where(array('md5("AD_Code")||'."'-'".'||"AD_FK_Code"' => $id))
 						->get("tblCOM_AttributeDetail")->row_array();


  }

}
