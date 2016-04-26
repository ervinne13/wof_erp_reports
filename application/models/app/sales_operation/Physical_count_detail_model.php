<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Physical_count_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_PCountSetup");
    }
    
   public function table_data($data){

		extract($data);

	    $this->db->select(array('PCS_PC_DocNo',
								'PCS_ItemType',
								'PCS_SubLocation',	
								'PCS_CS_CountSheetNo',							
								'md5(concat("PCS_CS_CountSheetNo")) as id'))
				 ->group_by("tblINV_PCountSetup.PCS_PC_DocNo,PCS_CS_CountSheetNo,PCS_ItemType,PCS_SubLocation");

		if(isset($id)){
			$this->db->where(array('MD5("PCS_PC_DocNo")'=>$id));
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
			$this->db->order_by('tblINV_PCountSetup.PCS_CS_CountSheetNo ASC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblINV_PCountSetup",false));
		
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
  						  ->where(array('MD5("PCS_PC_DocNo")'=>$this->id))
	    		 		 ->get("tblINV_PCountSetup");

	    return $result->row_array()['count'];
   }
   
  public function get_spec_datas($where) {

        $result = $this->db->select(array("PCS_CS_CountSheetNo", "PCS_ItemType", "PCS_SubLocation"))
                ->where($where)
                ->get("tblINV_PCountSetup");

        return $result->result_array();
  }

  public function get_spec_reason_array_per_module($countsheetno){
        $result = $this->db->select('PCS_ItemType')
               ->where(array('PCS_CS_CountSheetNo' => $countsheetno))
               ->get("tblINV_PCountSetup");

        return array('rows' => $result->num_rows(),
                     'data' => $result->result_array());
  }



  public function get_spec_array_per_itemtype_loc($countsheetno){
        $result = $this->db->select('*')
               ->where(array('PCS_CS_CountSheetNo' => $countsheetno))
               ->get("tblINV_PCountSetup");
         print_r($this->db->error());
         exit();
        return array('rows' => $result->num_rows(),
                     'data' => $result->result_array());
  }

}
