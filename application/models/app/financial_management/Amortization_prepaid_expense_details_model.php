<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amortization_prepaid_expense_details_model extends My_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_AMPDetail");
    }

   public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'MD5(CONCAT("AMPD_FK_DocNo","AMPD_LineNo")) as id',
	    						'DATE("AMPD_Date")',
	    						'"AMPH_CostCenter" as "CostCenter"',
	    						// '"COA_AccountName" as "AmortType"',
	    						))

	    		 ->join('tblACC_AMPHeader','AMPH_DocNo = AMPD_FK_DocNo','left')
	    		 // ->join('tblACC_ChartAccount','COA_Account_id = AMPD_Description','left')	    		
	    		 ->where(array('MD5("AMPD_FK_DocNo")'=>$id))
				 ->group_by("tblACC_AMPDetail.AMPD_LineNo,AMPD_FK_DocNo,AMPH_DocNo");


		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("AMPD_Date" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										// 'LOWER(CAST("COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMPD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMPH_CostCenter" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMPD_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("AMPD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_AMPDetail.DateCreated DESC');
		}
		
		$count = $this->db->query($this->db->get_compiled_select("tblACC_AMPDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count($id),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  } 
 //  public function record_count($id){
 //  	$result =	$this->db->select('COUNT(*)')
	//     		 		 ->where(array('AMPD_FK_DocNo' => $id))
	//     		 		 ->get("tblACC_AMPDetail");

	//     return $result->row_array()['count'];
 //   }

    public function get_spec_data($where){

		$result =	$this->db->select(array('*','md5("AMPD_FK_DocNo") as id','md5("AMPD_LineNo"::text) as mid'))
	 						 ->where($where)
	 						 ->get("tblACC_AMPDetail");
	 						 // print_r($this->db->error());
	 						 // exit();

	    return $result->row_array();
  }


 //   public function get_spec_data_array($where){

 //        $result =   $this->db->select(array('*','"COA_AccountName" as "AMPD_Description"',))
 //        					 ->join('tblACC_ChartAccount','COA_Account_id = AMPD_Description','left')
 //                             ->where($where)
 //                             ->get("tblACC_AMPDetail");
 //        return array('rows'     => $result->num_rows(),
 //                     'data'     => $result->result_array());
 //    }
 //  public function add_data($data){

 //  	$this->db->insert('tblACC_AMPDetail',add_data($data));



 //  	if($this->db->affected_rows() > 0){
 //  		return 1;
 //  	}else{
 //  		return 0;
 //  	}

 //  }
 //  public function update_data($where,$data){
	
	// $this->db->where($where)
 //  			 ->update('tblACC_AMPDetail',update_data($data));

 //  	if($this->db->affected_rows() > 0){
 //  		return 1;
 //  	}else{
 //  		return 0;
 //  	}

 //  }
 //  public function delete($where){

 //  	$this->db->where($where)
 //  			 ->delete('tblACC_AMPDetail');

 //  	if($this->db->affected_rows() > 0){
 //  		return 1;
 //  	}else{
 //  		return 0;
 //  	}

 //  }
 //   public function get_all_data($where){

 //   		$result =	$this->db->select('*')
 //   							 ->where($where)
	//     		 			 ->get("tblACC_AMPDetail");

	//     return array('rows' 	=> $result->num_rows(),
	//     		 	 'data' 	=> $result->result_array());

 //  }
}
