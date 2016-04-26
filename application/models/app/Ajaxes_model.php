<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxes_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }
 
  public function get_spec_company_per_location_array($where){

		$result =	$this->db->select(array('COM_Name','COM_Id'))
							 ->join('tblCOM_Company','tblINV_StoreProfile.SP_FK_CompanyID = tblCOM_Company.COM_Id','left')
	 						 ->where($where)
	 						 ->get('tblINV_StoreProfile');
	    return $result->row_array();
  
  }

  ////supliers/////
  public function get_supplier_per_query($params){

    $result = $this->db->select(array('S_Id','S_Name'))
             ->where(array('S_Active' => '1'))
             ->or_having(array(
                    'LOWER(CAST("S_Id" as text)) LIKE' => '%'.strtolower($params['q']).'%',
                    'LOWER(CAST("S_Name" as text)) LIKE' => '%'.strtolower($params['q']).'%',
                    ))
             ->limit($params['limit'])
             ->group_by('S_Id')
               ->get("tblCOM_Supplier");
    return $result->result_array();
  }

  public function get_supplier_dropdown(){

      $result = $this->db->select(array('S_Id','S_Name'))
                 ->where(array('S_Active' => '1'))
                 ->get("tblCOM_Supplier");

      return $result->result_array();
  }

  public function get_spec_data_per_supplier($where){

    $result = $this->db->select('*')
               ->join('tblACC_PaymentTerms','tblACC_PaymentTerms.PT_Id= tblCOM_Supplier.S_FK_PayTerms','left')
               ->where($where)
               ->get("tblCOM_Supplier");

      return $result->row_array();
  }

  ///////ITEM/////
  public function get_item_spec_items($where){

    $result = $this->db->select('*')
                       ->where($where)
                       ->get("tblINV_Item");
      return $result->result_array();

  }

  ////////RP//////
  public function amount_in_lcy_rp($data){

    extract($data);
    $result = $this->db->select(array('(CASE WHEN "tblACC_RPHeader"."RPH_Currency" = "tblCOM_Company"."COM_Currency" THEN '.$amount.' ELSE '.$amount.' * "ER_ConvCurrencyRate" END) as amount ','COALESCE("ER_ConvCurrencyRate",1) as "ER_ConvCurrencyRate" '))
                       ->join('tblCOM_Company','RPH_Company = COM_Id','left')
                       ->join('tblACC_ExchangeRate','ER_FK_BaseCurrency_id = tblACC_RPHeader.RPH_Currency AND ER_FK_ConvCurrency_id = tblCOM_Company.COM_Currency','left')
                       ->where($where)
                       ->get("tblACC_RPHeader");                
    return $result->row_array();
   
  }

  //////Position/////

  public function get_position_per_type($where){

    $result = $this->db->select('*')
                       ->where($where)
                       ->get("tblCOM_Position");
                       
    return $result->result_array();

  }

  ////////RQ///////

  public function get_applies_to_rq($value){
    switch ($value) {
      case '1000':
          $table = '';
        break;
      case '2000':
        $result = $this->db->select(array('"AMLH_DocNo" as docno','"AMLH_LoanAmount" as amount'))
                           ->where(array('AMLH_RunningBalance >' => 0))
                           ->where(array('AMLH_Status' => 'Approved'))
                           ->get('tblACC_AMLHeader');
        break;
    }
    
    return $result->result_array();
  }

///////Bank Account///////

  public function get_spec_data_per_account($data){
      $result = $this->db->select(array('GL_AccountID','GL_AccountName'))
                 ->where(array('GL_AccountType' => $data['BA_GLAccount']))
                 ->get("tblACC_GLEntry");                
      return $result->result_array();
  }

  ///////Physical Count///////

  public function get_spec_data_per_countsheet($data){
      $result = $this->db->select('*')
                 ->where(array('IM_FK_ItemType_id' => $data['CSD_CS_PCS_ItemType']))
                 ->get("tblINV_Item");                
      return $result->result_array();
  }  

}
