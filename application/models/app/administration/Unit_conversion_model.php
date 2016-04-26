<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_conversion_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('UC_DocNo',
	    						'MD5("UC_DocNo") as id',
			   					 "DATE(COALESCE(".'"UC_DocDate" :: text'.",'')) as  ".'"UC_DocDate"'." ",
								 'a.AD_Desc as base',
								 'UC_BaseQty',
								 'b.AD_Desc as conv',
								 'UC_ConversionQty',
								 "(CASE WHEN ".'"UC_Active"'." = 'TRUE' THEN 'Active' WHEN ".'"UC_Active"'." = 'FALSE' THEN 'Inactive' END) as ".'"UC_Active"'."",
								 "(CASE WHEN ".'"UC_DocumentStatus"'." = '0' THEN 'For Approval' WHEN ".'"UC_DocumentStatus"'." = '1' THEN 'Approved' END) as ".'"UC_DocumentStatus"'."",
								 ))
				 ->join('tblCOM_AttributeDetail as a','a.AD_Code = tblINV_UOMConversion.UC_FK_BaseUOM_id a.AD_FK_Code = '."'33'".'','left')
				 ->join('tblCOM_AttributeDetail as b','b.AD_Code = tblINV_UOMConversion.UC_FK_ConvUOM_id b.AD_FK_Code = '."'33'".'','left')
				 ->limit($perPage,$offset)
				 ->group_by("tblINV_UOMConversion.UC_DocNo,a.AD_Code,a.AD_FK_Code,b.AD_Code,b.AD_FK_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("UC_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("UC_BaseQty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("UC_ConversionQty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("b"."AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										"LOWER(CASE WHEN ".'"UC_Active"'." = 'TRUE' THEN 'Active' WHEN ".'"UC_Active"'." = 'FALSE' THEN 'Inactive' END) LIKE" => '%'.strtolower($queries['search']).'%',
										"LOWER(CASE WHEN ".'"UC_Active"'." = 'TRUE' THEN 'Active' WHEN ".'"UC_Active"'." = 'FALSE' THEN 'Inactive' END) LIKE" => '%'.strtolower($queries['search']).'%'
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('date("UC_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('date("UC_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by("tblINV_UOMConversion.DateCreated DESC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_UOMConversion",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_UOMConversion"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

}
