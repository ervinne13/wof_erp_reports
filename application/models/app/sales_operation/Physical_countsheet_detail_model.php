<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Physical_countsheet_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_PCountSheetDetails");
    }

   public function update_countsheet_detail($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);

  		// $this->db->trans_begin();
  		$details_where = array(
  			"CSD_CS_CountSheetNo" => $data["CSD_CS_CountSheetNo"],  			
  			"CSD_CS_PC_DocNo"     => $data["CSD_CS_PC_DocNo"]
  		);

  		$this->db->where($details_where)->delete('tblINV_PCountSheetDetails');
  		
  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
					
				// $value['CSD_CS_CountSheetNo'] 	 = $data['CSD_CS_CountSheetNo'];
		  	// $value['CSD_CS_PCS_ItemType']    = $data['CSD_CS_PCS_ItemType'];
		  	// $value['CSD_CS_PC_DocNo'] 	     = $data['CSD_CS_PC_DocNo'];
		  	// $value['CSD_CS_PCS_PC_DocNo']    = $data['CSD_CS_PCS_PC_DocNo'];
		  	// $value['CSD_CS_PCS_SubLocation'] = $data['CSD_CS_PCS_SubLocation'];

        // $details_data = array('CSD_CS_PC_DocNo'     => $data['CSD_CS_PC_DocNo'],
          //                       'CSD_CS_CountSheetNo' => $data['CSD_CS_CountSheetNo']);

          // $result = $this->db->select('*')
          //          ->where(array('IM_FK_ItemType_id' => $itemTypeId))
          //          ->get("tblINV_Item"); 

          $value['CSD_CS_PC_DocNo']     = $data['CSD_CS_PC_DocNo'];
          $value['CSD_CS_CountSheetNo'] = $data['CSD_CS_CountSheetNo'];
          $value['CSD_BaseUOM']         = $value['CSD_UOM'];
          $value['CSD_Variance']        = $value['CSD_TotalQty'] - $value['CSD_Count'];
          $value['CSD_SOH']             = '1';
          $value['CSD_TotalQty']        = '1';
          
					$this->add_data($value);

          // print_r($this->db->error());
          // exit();

          // echo"<prev></prev>";
          // print_r($value);
          // exit();
					// var_dump(array_merge($value,$data));
					// echo "inserted";
					// echo $this->db->last_query();
		  		}
	  		}
  		}

		// if ($this->db->trans_status() === FALSE) {
  //           $this->db->trans_rollback();
  //           return 0;
  //       } else {
  //       	$this->db->trans_commit();
  //           return 1;
  //       }
  	}  

  //    public function get_spec_datas($where) {

  //       $result = $this->db->select(array("*"))
  //               ->where($where)
  //               ->get("tblINV_PCountSheetDetails");

  //       print_r($this->db->error());
  //       exit();

  //       return array('rows'=> $result->num_rows(),
  //                    'data'=> $result->result_array());
  // }

}
