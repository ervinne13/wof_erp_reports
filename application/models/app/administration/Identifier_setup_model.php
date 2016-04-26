<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Identifier_setup_model extends My_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_IdentifierSetup");
    }


   public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("CAT_Id") as "id"', 
								'(CASE WHEN "CAT_Active" = '."'1'".' THEN '."'Active'".' WHEN "CAT_Active" = '."'0'".' THEN '."'Inactive'".' END) as "CAT_Active"'))
				 ->where(array("CAT_Active"=>'1'))
				 ->group_by("tblINV_Category.CAT_Id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("CAT_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("CAT_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										// 'LOWER(CAST("CAT_ItemBatch" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "CAT_Active" = '."'1'".' THEN '."'Active'".' WHEN "CAT_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblINV_Category.DateCreated DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_Category",false));
		
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
  						 ->where(array("CAT_Active"=>'1'))
	    		 		 ->get("tblINV_Category");

	    return $result->row_array()['count'];
   }

  public function update_main_data($id,$data){

  	$this->db->trans_start();
	
	  $cat = $this->db->where(array('md5("CAT_Id")'=>$id))
  			 		  ->get('tblINV_Category')->row_array();

  
	  	foreach ($data['delete'] as $key => $value) {
	  		$this->db->where(array('md5("IDS_FK_Category_id")' => $id))
	  				 ->where(array('IDS_FK_Identifier_id' => $value))
	  				 ->delete("tblINV_IdentifierSetup");

	  	}

	  	foreach ($data['add'] as $key => $value) {
	  		$this->db->insert("tblINV_IdentifierSetup",array('IDS_FK_Category_id' => $cat['CAT_Id'],'IDS_FK_Identifier_id' => $value));
	  	}
	  	

	  	$this->db->trans_complete();
	  	
	  	if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}

  }


  public function get_all_spec_data_json($cat,$sub){

  		$c = "'".$cat."'";
  		$s = "'".$sub."'";
  	  $query = $this->db->query('SELECT * , (select json_agg(d) FROM ( SELECT "IDD_Description","IDD_Id" FROM "tblINV_Identifier" d 
												LEFT JOIN "tblINV_IdentifierDetails" ON "IDD_FK_Identifier_id" = "ID_Id"
												where "ID_Id"= identifier_id AND "IDD_FK_SubCategory_id" = '.$s.' ) d ) as details 
								 FROM  (SELECT DISTINCT("IDS_FK_Identifier_id") identifier_id, "ID_Description"
										 FROM "tblINV_IdentifierSetup" 
										 LEFT JOIN "tblINV_Identifier" ON "ID_Id" = "IDS_FK_Identifier_id"
										 WHERE "IDS_FK_Category_id" = '.$c.' GROUP BY "IDS_FK_Category_id", "IDS_FK_Identifier_id","ID_Description") as a'
	   							); 

  	   return array('rows' => $query->num_rows(),
	    		 	 'data' => $query->result_array());
  	}

}
