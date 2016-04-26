<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxes extends CI_Controller {
  
  public function __construct()
    {
        parent::__construct();
      	
      	if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }

    public function get_spec_company_per_location_array(){
   		$this->load->model('app/ajaxes_model');
   		echo json_encode($this->ajaxes_model->get_spec_company_per_location_array(array('SP_StoreID' => $this->input->get('q'))));
    }

    ////Supplier////
    public function get_supplier_init(){
      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->get_supplier_dropdown());
    }

    public function get_supplier_per_query(){
      $this->load->model('app/administration/supplier_model');
      echo json_encode($this->supplier_model->get_dropdown_result($this->input->get()));
    }

    public function get_supplier_detail_per_query(){
      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->get_spec_data_per_supplier(array('S_Id'  =>  $this->input->get('q'))));
    }
	  
    /////Items/////
    public function get_item_per_item_type(){
      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->get_item_spec_items(array('IM_FK_ItemType_id'  =>  $this->input->get('q'))));
    }

    public function get_item_per_code(){
      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->get_item_spec_items(array('IM_Item_id'  =>  $this->input->get('q'))));
    }

    //////RP////
    public function amount_in_lcy_rp(){
      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->amount_in_lcy_rp(array(
                                                                    'where'    => array('md5("RPH_DocNo")' => $this->input->get('id',TRUE)),
                                                                    'amount'   => $this->input->get('amount')
                                                                  )
                                                            )
                      );
    }

    //////Position/////

    public function get_position_per_type(){
      $this->load->model('app/ajaxes_model');
      if(in_array($this->input->get('q'), array('1000','2000','3000','4000','5000','6000','7000'))){
        $type =(int) $this->input->get('q');
        echo json_encode($this->ajaxes_model->get_position_per_type(array('P_Type >' => (string) $type)));
      }
    }


    ////////AML////////

    public function get_applies_to_rq($value){

      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->get_applies_to_rq($value));

    }

    /////bankaccount////
     public function get_account_detail_per_query(){

      $this->load->model('app/ajaxes_model');
      echo json_encode($this->ajaxes_model->get_spec_data_per_account(array('GL_AccountType'  =>  $this->input->get('q'))));
    }

    public function get_endbal(){

      $result = $this->db->select('SUM("BAL_Amount") as total') 
              ->get("tblACC_BankAccountLedger");  
      return $result->row_array();
    }



}
