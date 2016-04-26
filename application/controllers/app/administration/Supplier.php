<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {
  
  private $module_id = 28;

  private $table 	 = "tblCOM_Supplier";

  public function __construct()
    {
        parent::__construct();
      	
      	if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }
    public function getseries_update(){
    	$this->load->model('app/administration/no_series_model');
    	echo json_encode($this->no_series_model->getseries_update($this->module_id));
    }
    public function getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'S_Id');

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
		$data['title'] = "Administration: Supplier";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-supplier' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'S_Id'			=> array('label' => 'Supplier ID'),
																'S_Name'		=> array('label' => 'Name'),
																'S_Address'		=> array('label' => 'Address'),
																'S_TelNum'		=> array('label' => 'Telephone #'),
																'S_TinNum'		=> array('label' => 'TIN #'),
																'S_Status'		=> array('label' => 'Status'),
																'S_Active'		=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view("app/administration/supplier/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function data(){
		
		$this->load->model('app/administration/supplier_model');

		$data = $this->supplier_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->supplier_model->record_count());
		}

		echo json_encode($result);

	}

	public function supplier_ledger()
	{		
		$data['title'] = "Supplier Ledger Entry";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-supplier-ledger' => array(					 			
															 	'SL_EntryNo'			 => array('label' => 'Entry No'),
																'SL_DocType'			 => array('label' => 'Doc Type'),
																'SL_DocDate'			 => array('label' => 'Doc Date'),				
																'SL_DocNo'				 => array('label' => 'Doc No'),				
																'SL_DocAmount'			 => array('label' => 'Doc Amount'),
																'SL_DocAmountLCY'		 => array('label' => 'Doc Amount LCY'),
																'SL_SupplierID'			 => array('label' => 'Supplier ID'),
																'SL_SupplierName'		 => array('label' => 'Supplier Name'),
																'SL_ExtDocNo'			 => array('label' => 'External Document No'),
																'SL_Currency'			 => array('label' => 'Currency ID'),
																'SL_SupplierPostingGroup'=> array('label' => 'Supplier Posting Group'),				
																'SL_PaymentTerms'		 => array('label' => 'Payment Terms'),				
																'SL_DueDate'			 => array('label' => 'Due Date'),
																'SL_Buyer'			 	 => array('label' => 'Buyer'),
																'SL_RequestedBy'		 => array('label' => 'Requested By'),
																'SL_Company'			 => array('label' => 'Company'),
																'SL_Location'			 => array('label' => 'Location'),
																'SL_RefDocType'			 => array('label' => 'Ref Doc Type'),
																'SL_RefDocNo'			 => array('label' => 'Ref Doc No'),
																'SL_RefDocAmount'		 => array('label' => 'Ref Doc Amount'),
																'SL_AppliesToDocType'	 => array('label' => 'Applies-to Doc Type'),
																'SL_AppliesToDocNo'		 => array('label' => 'Applies-to Doc No'),
																'SL_AppliesToDocDate'	 => array('label' => 'Applies-to Doc Date'),
																'SL_AppliesToID'		 => array('label' => 'Applies-to Doc ID'),
																'SL_AppliedAmount'	     => array('label' => 'Applied Amount'),					
																'SL_RemAmount'		     => array('label' => 'Remaining Amount'),
																'SL_PostedBy'			 => array('label' => 'Posted By'),
																'SL_DatePosted'			 => array('label' => 'Date Posted'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view("app/financial-management/supplier-ledger/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function supplier_ledger_data(){
		
		$this->load->model('app/supplier_ledger_entry_model');

		$data = $this->supplier_ledger_entry_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map_ledger'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->supplier_ledger_entry_model->record_count());
		}

		echo json_encode($result);

	}
	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Supplier: Add";
      	$this->load->vars($data);
			
		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('156');
		
		$content['currency'] = $this->attribute_model->get_spec_attribute_dropdown('34');
		
		$this->load->model('app/administration/payment_terms_model');
		$content['terms'] = $this->payment_terms_model->get_spec_data_array(array('PT_Active'=>'1'));

		$this->load->model('app/financial_management/VAT_bus_posting_group_model');
		$content['VAT'] 	= $this->VAT_bus_posting_group_model->get_spec_data_array(array('VBPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_bus_posting_group_model');
		$content['WHT'] 	= $this->WHT_bus_posting_group_model->get_spec_data_array(array('WBPG_Active'=>'1'));

		$this->load->model('app/financial_management/Supplier_posting_group_model');
		$content['Sup'] 	= $this->Supplier_posting_group_model->get_spec_data_array(array('SPG_Active'=>'1'));



		$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/supplier/add',$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Supplier: Edit";
      	$this->load->vars($data);

      	$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('156');
		
		$content['currency'] = $this->attribute_model->get_spec_attribute_dropdown('34');

		$this->load->model('app/administration/payment_terms_model');
		$content['terms'] = $this->payment_terms_model->get_spec_data_array(array('PT_Active'=>'1'));

		$this->load->model('app/financial_management/VAT_bus_posting_group_model');
		$content['VAT'] 	= $this->VAT_bus_posting_group_model->get_spec_data_array(array('VBPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_bus_posting_group_model');
		$content['WHT'] 	= $this->WHT_bus_posting_group_model->get_spec_data_array(array('WBPG_Active'=>'1'));

		$this->load->model('app/financial_management/Supplier_posting_group_model');
		$content['Sup'] 	= $this->Supplier_posting_group_model->get_spec_data_array(array('SPG_Active'=>'1'));


		$this->load->model('app/administration/supplier_model');
		$content['data'] 		=  $this->supplier_model->get_spec_data_row(array('md5("S_Id")' 	=>  $this->input->get('id')));
		$content['functions'] 	=  $this->approval_functions($this->input->get('id'));
		

		if(!empty($content['data'])){
			$content['data']['id']	=  $this->input->get('id');
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/supplier/update',$content,true)));	
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

	
	public function process(){

		$this->load->model('app/administration/supplier_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				$this->_set_default();
				if($this->_validate($this->_validation_config('add'))){
					$_POST['S_Active'] = '1';
					
					$this->supplier_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				$this->_set_default();
				if($this->_validate($this->_validation_config('update',$id))){
					unset($_POST['uniqid']);
					
					$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));
					
					$_POST['S_Active'] 	= '0';
					$_POST['S_Status'] 	= 'Open';
					$_POST['S_Updates'] = json_encode(array_diff_assoc($result,$this->input->post(NULL,TRUE)));

					$this->supplier_model->update_data(array('md5("S_Id"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->supplier_model->update_data(array('md5("S_Id"::text)' => $value),update_data(array('S_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->supplier_model->update_data(array('md5("S_Id"::text)' => $value),update_data(array('S_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->supplier_model->delete(array('md5("S_Id"::text)' => $this->input->post('id')));

			break;
			case 'send-approval-request':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

					$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));

					$data = array('DT_DocNo' 		=> $result['S_Id'],
								  'DT_FK_NSCode' 	=> explode('-', $result['S_Id'])[0],
								  'DT_Location' 	=> '',
								  'DT_DocDate'  	=> $result['DateCreated'],
								  'DT_TargetURL' 	=> base_url().'app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/update?id='.$id 
								 );
					
					$this->load->model('app/document_approval_model');
					if($this->document_approval_model->send_approval($data,NULL)){
						
						if($this->supplier_model->update_data(array('md5("S_Id"::text)' => $id),update_data(array('S_Status' => 'Pending')))){
							echo json_encode(array('status'=>1,'message'=>$this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id))['S_Status']));
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

				$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->approve($result['S_Id'],$this->table,'S_Id','S_Status')){
					$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));
					if($result['S_Status'] == 'Approved'){
						$this->supplier_model->update_data(array('md5("S_Id"::text)' => $id),array('S_Active'=>'1','S_Updates' => '[]'));
					}
					echo json_encode(array('status'=>1,'message'=>$result['S_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel($result['S_Id'],$this->table,'S_Status','S_Id','tblACC_RPDetails','RPD_PFK_DocNo')){
					echo 1;
				}else{
					echo 0;
				}
			break;
			case 'reject':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->reject($result['S_Id'],$this->table,'S_Id','S_Status',$this->input->post('DT_Remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id))['S_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel-approval':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel_approval($result['S_Id'],$this->table,'S_Id','S_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id))['S_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}

			break;
			case 're-open':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->re_open($result['S_Id'],$this->table,'S_Id','C_Status',$this->input->post('remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->supplier_model->get_spec_data_row(array('md5("S_Id")' => $id))['C_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'S_Id','S_Active');
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
			                //      'field'   => 'S_Id', 
			                //      'label'   => 'Supplier ID', 
			                //      'rules'   => 'TRIM|required|is_unique[tblCOM_Supplier.S_Id]'
			                //   ),
			                array(
			                     'field'   => 'S_Name', 
			                     'label'   => 'Supplier Name', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'S_CreditLimit', 
			                     'label'   => 'Credit Limit', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                array(
			                     'field'   => 'S_Address', 
			                     'label'   => 'Address', 
			                     'rules'   => 'TRIM|required|max_length[200]'
			                  ),             
			                array(
			                     'field'   => 'S_Addr_State', 
			                     'label'   => 'Country', 
			                     'rules'   => 'TRIM|required|max_length[25]'
			                  ),
			                array(
			                     'field'   => 'S_Addr_PostalCode', 
			                     'label'   => 'Postal Code', 
			                     'rules'   => 'TRIM|max_length[25]'
			                  ),			                
			                array(
			                     'field'   => 'S_TelNum', 
			                     'label'   => 'Telephone #', 
			                     'rules'   => 'TRIM|required|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'S_FaxNum', 
			                     'label'   => 'Fax #', 
			                     'rules'   => 'TRIM|required|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'S_TinNum', 
			                     'label'   => 'TIN #', 
			                     'rules'   => 'TRIM|max_length[16]'
			                  ),
			                array(
			                     'field'   => 'S_EmailAdd1', 
			                     'label'   => 'Email 1', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'S_EmailAdd2', 
			                     'label'   => 'Email 2', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),
			                array(
			                     'field'   => 'S_PrintCheckAs', 
			                     'label'   => 'Print Check As', 
			                     'rules'   => 'TRIM|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'S_BankAccountNo', 
			                     'label'   => 'Bank Account #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'S_FK_PayTerms',
			                     'label'   => 'Terms', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'S_SupplierType', 
			                     'label'   => 'Supplier Type', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'S_Contact', 
			                     'label'   => 'Contact', 
			                     'rules'   => 'TRIM|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'S_SupplierPostingGroup', 
			                     'label'   => 'Supplier Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'S_WHT_PostingGroup', 
			                     'label'   => 'WHT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'S_Vat_PostingGroup', 
			                     'label'   => 'VAT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'S_FK_Attribute_Currency_id', 
			                     'label'   => 'Currency', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'S_Contact', 
			                     'label'   => 'Contact', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),

                		),
			'update'	=> array(
								// array(
				    //                  'field'   => 'S_Id', 
				    //                  'label'   => 'Supplier ID', 
				    //                  'rules'   => 'TRIM|required|is_unique2[tblCOM_Supplier.S_Id.S_Id".'.$this->input->post('S_Id').']'
				    //              ),
								 array(
				                     'field'   => 'S_Name', 
				                     'label'   => 'Supplier Name', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'S_CreditLimit', 
				                     'label'   => 'Credit Limit', 
				                     'rules'   => 'TRIM|numeric'
				                  ),
				                array(
				                     'field'   => 'S_Address', 
				                     'label'   => 'Address', 
				                     'rules'   => 'TRIM|required|max_length[200]'
				                  ),             
				                array(
				                     'field'   => 'S_Addr_State', 
				                     'label'   => 'Country', 
				                     'rules'   => 'TRIM|required|max_length[25]'
				                  ),
				                array(
				                     'field'   => 'S_Addr_PostalCode', 
				                     'label'   => 'Postal Code', 
				                     'rules'   => 'TRIM|max_length[25]'
				                  ),			                
				                array(
				                     'field'   => 'S_TelNum', 
				                     'label'   => 'Telephone #', 
				                     'rules'   => 'TRIM|required|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'S_FaxNum', 
				                     'label'   => 'Fax #', 
				                     'rules'   => 'TRIM|required|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'S_TinNum', 
				                     'label'   => 'TIN #', 
				                     'rules'   => 'TRIM|max_length[16]'
				                  ),
				                array(
				                     'field'   => 'S_EmailAdd1', 
				                     'label'   => 'Email 1', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'S_EmailAdd2', 
				                     'label'   => 'Email 2', 
				                     'rules'   => 'TRIM|max_length[50]'
				                  ),
				                array(
				                     'field'   => 'S_PrintCheckAs', 
				                     'label'   => 'Print Check As', 
				                     'rules'   => 'TRIM|max_length[100]'
				                  ),
				                array(
				                     'field'   => 'S_BankAccountNo', 
				                     'label'   => 'Bank Account #', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'S_FK_PayTerms',
				                     'label'   => 'Terms', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'S_SupplierType', 
				                     'label'   => 'Supplier Type', 
				                     'rules'   => 'TRIM|required|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'S_Contact', 
				                     'label'   => 'Contact', 
				                     'rules'   => 'TRIM|max_length[100]'
				                  ),
				                array(
				                     'field'   => 'S_SupplierPostingGroup', 
				                     'label'   => 'Supplier Posting Group', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'S_WHT_PostingGroup', 
				                     'label'   => 'WHT Posting Group', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'S_Vat_PostingGroup', 
				                     'label'   => 'VAT Posting Group', 
				                     'rules'   => 'TRIM|max_length[30]'
				                  ),
					              array(
					                     'field'   => 'S_FK_Attribute_Currency_id', 
					                     'label'   => 'Currency', 
					                     'rules'   => 'TRIM|required'
					                  ),
					              array(
					                     'field'   => 'S_Contact', 
					                     'label'   => 'Contact', 
					                     'rules'   => 'TRIM|required|max_length[100]'
					                  ),

						),
            );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(

					'S_CreditLimit'			=> 'numeric',	
					'S_SupplierPostingGroup'=> 'null',
					'S_WHT_PostingGroup'	=> 'null',
					'S_Vat_PostingGroup'	=> 'null'
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
		
		$value['checkbox']  = $value['S_Status'] == 'Approved' ? $this->_checkbox($value['id']):'';
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

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
	}

	private function approval_functions($id){

		$this->load->model('app/administration/supplier_model');
		$this->load->model('app/transaction_module_functions');

		$result = $this->supplier_model->get_spec_data_row_spec_fields(array('S_Id'),array('md5("S_Id")' => $id));

		$function['functions'] = $this->transaction_module_functions->get_module_functions($this->table,$result['S_Id'],'S_Id','S_Status','CreatedBy',$this->module_id);
		
		$function['functions']['supplier'] = 'Supplier Ledger';

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
