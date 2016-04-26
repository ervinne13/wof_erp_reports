<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_ledger extends CI_Controller{

  public function __construct()
    {
        parent::__construct();
        
        if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }

  private function _settings(){

      	$data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');
      	$this->load->vars($data);
      	$page 			= array('header'	=> $this->load->view("templates/header","",true),
							  	'footer'	=> $this->load->view("templates/footer","",true),
							  	'navs'		=> $this->load->view('templates/side-nav',"",true),
							  	'head'		=> $this->load->view("templates/head-nav","",true),
							  );
      	return $page;

    }

	public function index()
	{		
		$data['title'] = "Customer Ledger Entry";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-customer-ledger' => array(					 			
															 	'CL_EntryNo'			 => array('label' => 'Entry No'),
																'CL_DocType'			 => array('label' => 'Doc Type'),
																'CL_DocDate'			 => array('label' => 'Doc Date'),				
																'CL_DocNo'				 => array('label' => 'Doc No'),				
																'CL_DocAmount'			 => array('label' => 'Doc Amount'),
																'CL_CustomerID'			 => array('label' => 'Customer ID'),
																'CL_CustomerName'		 => array('label' => 'Customer Name'),
																'CL_ExtDocNo'			 => array('label' => 'External Document No'),
																'CL_CustomerPostingGroup'=> array('label' => 'Customer Posting Group'),				
																'CL_PaymentTerms'		 => array('label' => 'Payment Terms'),				
																'CL_DueDate'			 => array('label' => 'Due Date'),
																'CL_Company'			 => array('label' => 'Company'),
																'CL_CPC'				 => array('label' => 'Cost Center'),
																'CL_BalAccountType'		 => array('label' => 'Bal. Account Type'),
																'CL_BalAccountNo'		 => array('label' => 'Bal. Account No.'),				
																'CL_BalAccountName'		 => array('label' => 'Bal. Account Name'),				
																'CL_AppliesToDocType'	 => array('label' => 'Applies-to Doc Type'),
																'CL_AppliesToDocNo'		 => array('label' => 'Applies-to Doc No'),
																'CL_AppliesToDocDate'	 => array('label' => 'Applies-to Doc Date'),
																'CL_AppliesToID'		 => array('label' => 'Applies-to Doc ID'),
																'CL_AppliedAmount'	     => array('label' => 'Applied Amount'),	
																'CL_WHTAmount'			 => array('label' => 'WHT Amount'),			
																'CL_VATAmount'			 => array('label' => 'VAT Amount'),				
																'CL_RemAmount'		     => array('label' => 'Remaining Amount'),
																'CL_Status'				 => array('label' => 'Status'),
																'CL_PostedBy'			 => array('label' => 'Posted By'),
																'CL_DatePosted'			 => array('label' => 'Date Posted'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view("app/administration/customer/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function data(){
		
		$this->load->model('app/administration/customer_model');

		$data = $this->customer_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->customer_model->record_count());
		}

		echo json_encode($result);

	}
  private function _map(&$value){
    

    foreach ($value AS $key => $item) {
            if ($item === null) {
                $value[$key] = '';
            }
        }

    return $value;
  }
}
