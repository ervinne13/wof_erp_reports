<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mask_category_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

   public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'(CASE WHEN "MC_LabelUse" = '."'1'".' THEN '."'True'".' WHEN "MC_LabelUse" = '."'0'".' THEN '."'False'".' END) as "MC_LabelUse"',
								'(CASE WHEN "MC_Active" = '."'1'".' THEN '."'Active'".' WHEN "MC_Active" = '."'0'".' THEN '."'Inactive'".' END) as "MC_Active"'))
				 ->group_by("tblINV_MaskCat.MC_Level");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("MC_Level" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("MC_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("MC_Width" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "MC_LabelUse" = '."'1'".' THEN '."'True'".' WHEN "MC_LabelUse" = '."'0'".' THEN '."'False'".' END) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "MC_Active" = '."'1'".' THEN '."'Active'".' WHEN "MC_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblINV_MaskCat.DateCreated DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_MaskCat",false));
		
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
	    		 		 ->get("tblINV_MaskCat");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
   							 ->where(array('MC_Active' => '1'))
	    		 			 ->get("tblINV_MaskCat");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data($where){

		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblINV_MaskCat");

	    return $result->row_array();
  }

  public function add_data($data){

  	$this->db->insert('tblINV_MaskCat',add_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->where($where)
  			 ->update('tblINV_MaskCat',update_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblINV_MaskCat');

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

}
