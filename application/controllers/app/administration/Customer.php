<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
  private $module_id = 27;	

  private $table 	 = "tblACC_Customer";
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
		$data['title'] = "Administration: Customer";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-customer' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'C_Id'			=> array('label' => 'Customer ID'),
																'C_Name'		=> array('label' => 'Customer Name'),
																'C_CompanyName'	=> array('label' => 'Company'),				
																'C_TIN_No'		=> array('label' => 'TIN #'),				
																'C_Status'		=> array('label' => 'Status'),
																'C_Active'		=> array('label' => 'Active'),
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


	public function customer_ledger()
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
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view("app/financial-management/customer-ledger/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function customer_ledger_data(){
		
		$this->load->model('app/customer_ledger_entry_model');

		$data = $this->customer_ledger_entry_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map_ledger'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->customer_ledger_entry_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Customer: Add";
      	$this->load->vars($data);
		
		$this->load->model('app/administration/customer_type_model');
		$content['ctype'] = $this->customer_type_model->get_spec_data_array(array('CT_Active'=>'1'));
		
		$this->load->model('app/administration/payment_terms_model');
		$content['terms'] = $this->payment_terms_model->get_spec_data_array(array('PT_Active'=>'1'));
		
		$this->load->model('app/financial_management/VAT_bus_posting_group_model');
		$content['VAT'] 	= $this->VAT_bus_posting_group_model->get_spec_data_array(array('VBPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_bus_posting_group_model');
		$content['WHT'] 	= $this->WHT_bus_posting_group_model->get_spec_data_array(array('WBPG_Active'=>'1'));

		$this->load->model('app/financial_management/Customer_posting_group_model');
		$content['Cust'] 	= $this->Customer_posting_group_model->get_spec_data_array(array('CPG_Active'=>'1'));

		$this->load->model('app/administration/customer_model');
		$content['customer'] 	= $this->customer_model->get_spec_data_array(array('C_Active'=>'1'));

		$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/customer/add',$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Customer: Edit";
      	$this->load->vars($data);

      	$this->load->model('app/administration/customer_type_model');
		$content['ctype'] = $this->customer_type_model->get_spec_data_array(array('CT_Active'=>'1'));
		
		$this->load->model('app/administration/payment_terms_model');
		$content['terms'] = $this->payment_terms_model->get_spec_data_array(array('PT_Active'=>'1'));
		
		$this->load->model('app/financial_management/VAT_bus_posting_group_model');
		$content['VAT'] 	= $this->VAT_bus_posting_group_model->get_spec_data_array(array('VBPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_bus_posting_group_model');
		$content['WHT'] 	= $this->WHT_bus_posting_group_model->get_spec_data_array(array('WBPG_Active'=>'1'));

		$this->load->model('app/financial_management/Customer_posting_group_model');
		$content['Cust'] 	= $this->Customer_posting_group_model->get_spec_data_array(array('CPG_Active'=>'1'));

      	$this->load->model('app/administration/customer_model');
      	$content['customer'] 	= $this->customer_model->get_spec_data_array(array('C_Active'=>'1'));
		$content['data'] 		= $this->customer_model->get_spec_data_row(array('md5("C_Id")' 	=>  $this->input->get('id')));
		$content['functions'] 	= $this->approval_functions($this->input->get('id'));

		if(!empty($content['data'])){
			$content['data']['id']	=  $this->input->get('id');
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/customer/update',$content,true)));	
			$this->load->view("templates/container", $page);
		}else{
			redirect(site_url()."app/error");
		}
	}
	
	public function back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($pk, $this->table);

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3));
	}
	public function getseries_update(){
    	$this->load->model('app/administration/no_series_model');
    	echo json_encode($this->no_series_model->getseries_update($this->module_id));
    }
	public function getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'C_Id');
		if($data['rows'] == 0){
			echo json_encode(array('rows'=>$data['rows']));
		}else if($data['rows'] == 1){
			echo json_encode(array('rows'=>$data['rows'],'data'=> $data['data'][0]['NS_Id'].'-'.$data['data'][0]['nsnum'],'uniqid' => $data['data'][0]['uniq']));
		}else{
			echo json_encode(array('rows'=>$data['rows']));
		}
	}
	
	public function seriesmodal(){
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id);
		$this->load->view('app/administration/no-series/series',$data);
	}

	public function process(){

		$this->load->model('app/administration/customer_model');

		$tinSettings = array(
	                     'field'   => 'C_TIN_No', 
	                     'label'   => 'TIN #', 
	                     'rules'   => 'TRIM|max_length[30]'
                  		);

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);

				$this->_set_default();
				$this->load->model('app/administration/customer_type_model');
				$config = $this->_validation_config('add'); 
				if($this->customer_type_model->get_spec_data_row(array('CT_Id' => $this->input->post('C_FK_CustomerType')))['CT_TinRequired'] == 1){
					 $tinSettings['rules'] .= '|required';
				}
				array_push($config, $tinSettings); 

				if($this->_validate($config)){
					$_POST['C_Active'] = '1';
					
					$this->customer_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				$this->_set_default();
				$this->load->model('app/administration/customer_type_model');
				$config = $this->_validation_config('update',$id); 
			
				if($this->customer_type_model->get_spec_data_row(array('CT_Id' => $this->input->post('C_FK_CustomerType')))['CT_TinRequired'] == 1){
					 
					 $tinSettings['rules'] .= '|required';
				}
				array_push($config, $tinSettings);
				if($this->_validate($config)){
					unset($_POST['uniqid']);
					
					$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));
		
					$_POST['C_Status'] 	= 'Open';
					$_POST['C_Active'] 	= '0';
					$_POST['C_Updates'] = json_encode(array_diff_assoc($result,$this->input->post(NULL,TRUE)));
					
					$this->customer_model->update_data(array('md5("C_Id")' => $id),update_data($this->input->post(NULL,TRUE)));
				
					$this->load->model('app/administration/user_record_lock_model');
					$this->user_record_lock_model->record_unlock($id, $this->table);
					
					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'activate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->customer_model->update_data(array('md5("C_Id"::text)' => $value),update_data(array('C_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->customer_model->update_data(array('md5("C_Id"::text)' => $value),update_data(array('C_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->customer_model->delete(array('md5("C_Id"::text)' => $this->input->post('id')));

			break;
			case 'send-approval-request':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

					$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));

					$data = array('DT_DocNo' 		=> $result['C_Id'],
								  'DT_FK_NSCode' 	=> explode('-', $result['C_Id'])[0],
								  'DT_Location' 	=> '',
								  'DT_DocDate'  	=> $result['DateCreated'],
								  'DT_TargetURL' 	=> base_url().'app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/update?id='.$id 
								 );
					
					$this->load->model('app/document_approval_model');
					if($this->document_approval_model->send_approval($data,NULL)){
						
						if($this->customer_model->update_data(array('md5("C_Id"::text)' => $id),update_data(array('C_Status' => 'Pending')))){
							echo json_encode(array('status'=>1,'message'=>$this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id))['C_Status']));
						}else{
							echo json_encode(array('status'=>0));
						}
					
					}else{
						echo json_encode(array('status'=>0,'message'=>'Set up approvers!'));
					}
			break;
			case 'approve':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->approve($result['C_Id'],$this->table,'C_Id','C_Status')){
					$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));
					if($result['C_Status'] == 'Approved'){
						$this->customer_model->update_data(array('md5("C_Id"::text)' => $id),array('C_Active'=>'1','C_Updates' => '[]'));
					}
					echo json_encode(array('status'=>1,'message'=>$result['C_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel($result['C_Id'],$this->table,'C_Status','C_Id','tblACC_RPDetails','RPD_PFK_DocNo')){
					echo 1;
				}else{
					echo 0;
				}
			break;
			case 'reject':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->reject($result['C_Id'],$this->table,'C_Id','C_Status',$this->input->post('DT_Remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id))['C_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel-approval':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel_approval($result['C_Id'],$this->table,'C_Id','C_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id))['C_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}

			break;
			case 're-open':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->re_open($result['C_Id'],$this->table,'C_Id','C_Status',$this->input->post('remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->customer_model->get_spec_data_row(array('md5("C_Id")' => $id))['C_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'C_Id','C_Active');
				$this->load->model('app/administration/user_record_lock_model');
				$this->user_record_lock_model->record_unlock($data['id'], $this->table);
				
				if($data){
					echo json_encode(array('result' => 1,'data'=>$data['NS_Id'].'-'.$data['NS_LastNoUsed'],'uniqid'=>$data['id']));
				}else{
					echo json_encode(array('result' => 0));
				}
				
			break;
		}
	}


	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                // array(
			                //      'field'   => 'C_Id', 
			                //      'label'   => 'Customer ID', 
			                //      'rules'   => 'TRIM|required|is_unique[tblACC_Customer.C_Id]|max_length[30]'
			                //   ),
			                array(
			                     'field'   => 'C_Name', 
			                     'label'   => 'Customer Name', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_CreditLimit', 
			                     'label'   => 'Credit Limit', 
			                     'rules'   => 'TRIM|numeric'
			                  ),			                
			                array(
			                     'field'   => 'C_LateCharge', 
			                     'label'   => 'Late Charge', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                array(
			                     'field'   => 'C_PenaltyCharge', 
			                     'label'   => 'Penalty Charge', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                array(
			                     'field'   => 'C_Address1', 
			                     'label'   => 'Address', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),			           
			                array(
			                     'field'   => 'C_Address3', 
			                     'label'   => 'Address 3', 
			                     'rules'   => 'TRIM|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'C_TelNum', 
			                     'label'   => 'Telephone #', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'C_FaxNum', 
			                     'label'   => 'Fax #', 
			                     'rules'   => 'TRIM|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'C_Email', 
			                     'label'   => 'Email', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'C_CompanyName', 
			                     'label'   => 'Company Name', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'C_ContactName', 
			                     'label'   => 'Contact Name', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'C_ContactTitle', 
			                     'label'   => 'Contact Title', 
			                     'rules'   => 'TRIM|required|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'C_PostalCode', 
			                     'label'   => 'Postal Code', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_Country', 
			                     'label'   => 'Country', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'C_FK_PayTerms', 
			                     'label'   => 'Terms', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_FK_CustomerType', 
			                     'label'   => 'CustomerType', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_BillTo', 
			                     'label'   => 'Bill to', 
			                     'rules'   => 'TRIM|max_length[200]'
			                  ),
			                array(
			                     'field'   => 'C_ShipTo', 
			                     'label'   => 'Ship to', 
			                     'rules'   => 'TRIM|max_length[200]'
			                  ),
			                array(
			                     'field'   => 'C_AccountNo', 
			                     'label'   => 'Bank Account #', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'C_FK_SalesRep', 
			                     'label'   => 'Sales Rep', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),			                
			                array(
			                     'field'   => 'C_CustomerPostingGroup', 
			                     'label'   => 'Customer Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_WHTPostingGroup', 
			                     'label'   => 'WHT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_VATPostingGroup', 
			                     'label'   => 'VAT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'C_Discount', 
			                     'label'   => 'Discount', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                array(
			                     'field'   => 'C_BankName', 
			                     'label'   => 'Bank Name', 
			                     'rules'   => 'TRIM|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'C_BankAddress', 
			                     'label'   => 'Bank Address', 
			                     'rules'   => 'TRIM|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'C_TIN_', 
			                     'label'   => 'TIN #', 
			                     'rules'   => 'TRIM|max_length[16]'
			                  ),
			                array(
			                     'field'   => 'C_BillDate', 
			                     'label'   => 'Bill Date', 
			                     'rules'   => 'TRIM|required|in_list[0,1]'
			                  )

               		),
			'update'	=> array(
								 // array(
				     //                 'field'   => 'C_Id', 
				     //                 'label'   => 'Customer ID', 
				     //                 'rules'   => 'TRIM|required|is_unique2[tblACC_Customer.C_Id.C_Id.'.$this->input->post('C_Id').']'
				     //             ),
								array(
				                     'field'   => 'C_Name', 
				                     'label'   => 'Customer Name', 
				                     'rules'   => 'TRIM|required|max_length[30]'
			                 	 ),
				                array(
				                     'field'   => 'C_CreditLimit', 
				                     'label'   => 'Credit Limit', 
				                     'rules'   => 'TRIM|numeric'
				                  ),				                
				                array(
				                     'field'   => 'C_LateCharge', 
				                     'label'   => 'Late Charge', 
				                     'rules'   => 'TRIM|numeric'
				                  ),
				                array(
				                     'field'   => 'C_PenaltyCharge', 
				                     'label'   => 'Penalty Charge', 
				                     'rules'   => 'TRIM|numeric'
				                  ),
				                array(
				                     'field'   => 'C_Address1', 
				                     'label'   => 'Address', 
				                     'rules'   => 'TRIM|required|max_length[100]'
				                  ),				                
				                array(
				                     'field'   => 'C_Address3', 
				                     'label'   => 'Address 3', 
				                     'rules'   => 'TRIM|max_length[100]'
				                  ),
				                array(
				                     'field'   => 'C_TelNum', 
				                     'label'   => 'Telephone #', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'C_FaxNum', 
				                     'label'   => 'Fax #', 
				                     'rules'   => 'TRIM|max_length[100]'
				                  ),
				                array(
				                     'field'   => 'C_Email', 
				                     'label'   => 'Email', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'C_CompanyName', 
				                     'label'   => 'Company Name', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'C_ContactName', 
				                     'label'   => 'Contact Name', 
				                     'rules'   => 'TRIM|required|max_length[100]'
				                  ),
				                array(
				                     'field'   => 'C_ContactTitle', 
				                     'label'   => 'Contact Title', 
				                     'rules'   => 'TRIM|required|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'C_PostalCode', 
				                     'label'   => 'Postal Code', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'C_Country', 
				                     'label'   => 'Country', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'C_FK_PayTerms', 
				                     'label'   => 'Terms', 
				                     'rules'   => 'TRIM|required|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'C_FK_CustomerType', 
				                     'label'   => 'CustomerType', 
				                     'rules'   => 'TRIM|required|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'C_BillTo', 
				                     'label'   => 'Bill to', 
				                     'rules'   => 'TRIM|max_length[200]'
				                  ),
				                array(
				                     'field'   => 'C_ShipTo', 
				                     'label'   => 'Ship to', 
				                     'rules'   => 'TRIM|max_length[200]'
				                  ),
				                array(
				                     'field'   => 'C_AccountNo', 
				                     'label'   => 'Bank Account #', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'C_FK_SalesRep', 
				                     'label'   => 'Sales Rep', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),			                
				                array(
				                     'field'   => 'C_CustomerPostingGroup', 
				                     'label'   => 'Customer Posting Group', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'C_WHTPostingGroup', 
				                     'label'   => 'WHT Posting Group', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'C_VATPostingGroup', 
				                     'label'   => 'VAT Posting Group', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'C_Discount', 
				                     'label'   => 'Discount', 
				                     'rules'   => 'TRIM|numeric'
				                  ),
				                array(
				                     'field'   => 'C_BankName', 
				                     'label'   => 'Bank Name', 
				                     'rules'   => 'TRIM|max_length[100]'
				                  ),
				                array(
				                     'field'   => 'C_BankAddress', 
				                     'label'   => 'Bank Address', 
				                     'rules'   => 'TRIM|max_length[100]'
				                  ),
					                 array(
				                     'field'   => 'C_TIN_', 
				                     'label'   => 'TIN #', 
				                     'rules'   => 'TRIM|max_length[16]'
			                  	  ),
				                array(
				                     'field'   => 'C_BillDate', 
				                     'label'   => 'Bill Date', 
				                     'rules'   => 'TRIM|required|in_list[0,1]'
				                  )
						),
            );
		$this->form_validation->set_message('in_list', 'Invalid selection');
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					'C_CreditLimit'			=> 'numeric',					
					// 'C_LateCharge'			=> 'numeric',
					// 'C_PenaltyCharge'		=> 'numeric',
					// 'C_Discount'			=> 'numeric',
					'C_BillTo'				=> 'null',
					'C_BillDate'			=> 'null',
					'C_CustomerPostingGroup'=> 'null',
					'C_WHTPostingGroup'		=> 'null',
					'C_VATPostingGroup'		=> 'null'
					);

		$this->load->library('set_default');
		$this->set_default->set_config($config);
		$this->set_default->run();
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	


	
	private function _checkbox($id=""){
		return '<input type="checkbox" class="doc" id="'.$id.'" />';
	}


	private function _map(&$value){
		
		$value['checkbox']  = $value['C_Status'] == 'Approved' ? $this->_checkbox($value['id']):'';
		$value['buttons'] 	= $this->_access_inline($value['id']);

		return $value;
	}


	private function _map_ledger(&$value){

		
		foreach ($value AS $key => $item) {
            if ($item === null) {
                $value[$key] = '';

		return $value;
	}}

	}


	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		$function = $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id));

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $function),true);
	
	}

	private function approval_functions($id){

		$this->load->model('app/administration/customer_model');
		$this->load->model('app/transaction_module_functions');

		$result = $this->customer_model->get_spec_data_row_spec_fields(array('C_Id'),array('md5("C_Id")' => $id));

		$function['functions'] = $this->transaction_module_functions->get_module_functions($this->table,$result['C_Id'],'C_Id','C_Status','CreatedBy',$this->module_id);
		
		$function['functions']['customer'] = 'Customer Ledger';

		$function['id']		   = $id;
		
		return $this->load->view("templates/approval_functions",$function,true);
	}

	private function _map_access(&$value){
		
		if($value['UA_AccessName'] == 'Edit'){

		$url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:FALSE;
		$newAccess = explode('/',$url);
		$newAccess = $newAccess[5].'/'.$newAccess[6];
		$value['UA_Trigger']  = $url!==FALSE ? $newAccess.'/update':$this->uri->segment(2).'/'.$this->uri->segment(3).'/update';
			
		}

		if($value['UA_AccessName'] == 'Add'){
			
			$value['UA_Trigger']  = $this->uri->segment(2).'/'.$this->uri->segment(3).'/add';
			
		}

		return $value;
	}

	private function _access_inline($id=""){

		$this->load->model('app/administration/user_profile_model');

		$access = $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->module_id));
		$access = $dataresult  = array_map(array($this, '_map_access'), $access);
	

		return  $this->load->view("templates/access_inline",array('id'		=> $id,
																  'access' 	=> $access),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');
		$access = $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->module_id));
		$access = $dataresult  = array_map(array($this, '_map_access'), $access);

		return  $this->load->view("templates/access_inline",array('access' => $access),true);

	}
	
}
