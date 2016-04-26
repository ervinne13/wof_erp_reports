<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_payable_voucher_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_APVDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array("*",'MD5(CONCAT("APVD_PFK_DocNo","APVD_LineNo")) as id','"a"."AD_Code" as base','"b"."AD_Code" as conv'))
				 ->join('tblCOM_AttributeDetail a','a.AD_Id = CAST("APVD_Currency" as integer)','left')
				 ->join('tblCOM_AttributeDetail b','b.AD_Id = CAST("APVD_BaseCurrency" as integer)','left')
				 ->where(array('MD5("APVD_PFK_DocNo")'=>$id))
				 ->group_by("APVD_PFK_DocNo,APVD_LineNo,a.AD_Code,b.AD_Code,a.AD_FK_Code,b.AD_FK_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("APVD_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_UOM" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Currency" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_UnitPrice" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_AmountLCY" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_ExchangeRate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_CostCenter" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_VAT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_WHT" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_RefFrom" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_RefTo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_SubLocation" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_BaseCurrency" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_LineDiscPerc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("APVD_LineDiscAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
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
			$this->db->order_by('tblACC_APVDetail.DateCreated DESC');
		}
			
		$this->id = $id;
		$count = $this->db->query($this->db->get_compiled_select("tblACC_APVDetail",false));
		
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
  						 ->where(array('MD5("APVD_PFK_DocNo")'=>$this->id))
	    		 		 ->get("tblACC_APVDetail");

	    return $result->row_array()['count'];
   }

  public function delete($where){
   	$this->db->trans_start();

   	$result = $this->db->select(array('APVD_TargetTable','APVD_RefFromLineNo','APVD_RefFrom'))
   	 		  		   ->where($where)
   	 		  		   ->get('tblACC_APVDetail')->row_array();
   	 		  		
   	$tablefields = array('tblACC_RPDetails' => array('status'  =>'RPD_Status',
   	 	   											 'filters' => array('RPD_PFK_DocNo' => $result['APVD_RefFrom'],
   	 	   											  					'RPD_LineNo'    => $result['APVD_RefFromLineNo'])));
   	
    $this->db->where($where)
             ->delete("tblACC_APVDetail");
           
    $this->db->where($tablefields[$result['APVD_TargetTable']]['filters'])    
     		 ->update($result['APVD_TargetTable'],array($tablefields[$result['APVD_TargetTable']]['status'] => 'Open'));
     
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE){
	    return 0;
	}else{
		return 1;
	}
  
  }

}
