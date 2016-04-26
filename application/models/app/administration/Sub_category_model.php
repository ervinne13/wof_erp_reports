<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_category_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
         MY_Model::set_table("tblINV_SubCategory");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("SC_Id") as "id"', 
	    						'', 
								'(CASE WHEN "SC_Active" = '."'1'".' THEN '."'Active'".' WHEN "SC_Active" = '."'0'".' THEN '."'Inactive'".' END) as "SC_Active"'))
				 ->join('tblINV_Category','CAT_Id = SC_FK_Category_id','left')
				 ->group_by("tblINV_SubCategory.SC_Id,CAT_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("SC_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SC_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CAT_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "SC_Active" = '."'1'".' THEN '."'Active'".' WHEN "SC_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblINV_SubCategory.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblINV_SubCategory",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		//$result = $this->db->get("tblCOM_Module");

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_SubCategory"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
}
