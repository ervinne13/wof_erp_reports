<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
 
  private $module_id = 17;

  private $table 	 = "tblCOM_Company";

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
    
    public function getseries_update(){
    	$this->load->model('app/administration/no_series_model');
    	echo json_encode($this->no_series_model->getseries_update($this->module_id));
    }
    public function getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'COM_DocNo',array('COM_Id' => 'temp-'.uniqid()));
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

	public function index()
	{		
		$data['title'] = "Administration: Company";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-company' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'COM_Id'		=> array('label' => 'Company ID'),
																'COM_Name'		=> array('label' => 'Company Name'),
																'COM_Address'	=> array('label' => 'Address'),
																'COM_PhoneNo'	=> array('label' => 'Phone #'),
																'COM_FaxNum'	=> array('label' => 'Fax #'),
																'COM_Email'		=> array('label' => 'Email'),
																'COM_Status'	=> array('label' => 'Status'),
																'COM_Active'	=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);

	}

	public function data(){
		
		$this->load->model('app/administration/company_model');

		$data = $this->company_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->company_model->record_count());
		}

		echo json_encode($result);

	}
	public function add(){
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Company: Add";
      	$this->load->vars($data);


		// $this->load->model('app/administration/No_series_model');
		
		// if($this->check_if_has_series($this->module_id)){
		// 	$series = $this->get_series_result();
		// 	$content['series'] = $this->load->view('templates/series_template');
		// }


		$this->load->model('app/administration/attribute_model');
		$content['cur'] 		= $this->attribute_model->get_spec_attribute_dropdown('34');



		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	
	}

	public function update($id=""){
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Company: Edit";
      	$this->load->vars($data);

      	$this->load->model('app/administration/attribute_model');
		$content['cur'] 		= $this->attribute_model->get_spec_attribute_dropdown('34');

      	$this->load->model('app/administration/company_model');
		$content['data']	 	= $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $this->input->get('id')));
		$content['functions'] 	= $this->approval_functions($this->input->get('id'));

		if(!empty($content['data'])){
			$content['data']['id']	= $this->input->get('id');
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/company/update',$content,true)));	
			$this->load->view("templates/container", $page);
		}else{
			redirect(site_url()."app/error");
		}
	}

	public function back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($pk, $this->table);

		redirect(site_url()."app/administration/company");
	}

	public function process(){

		$this->load->model('app/administration/company_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['COM_Active'] = '1';
					
					$this->_set_default();
					$this->company_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('update',$id))){
					unset($_POST['uniqid']);
					
					$this->_set_default();
					$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));
					
					$_POST['COM_Status'] 	= 'Open';
					$_POST['COM_Active'] 	= '0';
					$_POST['COM_Updates'] 	= json_encode(array_diff_assoc($result,$this->input->post(NULL,TRUE)));
					

					$this->company_model->update_data(array('md5("COM_DocNo"::text)' => $id),update_data($this->input->post(NULL,TRUE)));

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
					
					$this->company_model->update_data(array('md5("COM_DocNo"::text)' => $value),update_data(array('COM_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->company_model->update_data(array('md5("COM_DocNo"::text)' => $value),update_data(array('COM_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->company_model->delete(array('md5("COM_DocNo"::text)' => $this->input->post('id')));

			break;
			case 'send-approval-request':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

					$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));

					$data = array('DT_DocNo' 		=> $result['COM_DocNo'],
								  'DT_FK_NSCode' 	=> explode('-', $result['COM_DocNo'])[0],
								  'DT_Location' 	=> '',
								  'DT_DocDate'  	=> $result['DateCreated'],
								  'DT_TargetURL' 	=> base_url().'app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/update?id='.$id 
								 );
					
					$this->load->model('app/document_approval_model');
					if($this->document_approval_model->send_approval($data,NULL)){
						
						if($this->company_model->update_data(array('md5("COM_DocNo"::text)' => $id),update_data(array('COM_Status' => 'Pending')))){
							echo json_encode(array('status'=>1,'message'=>$this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id))['COM_Status']));
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

				$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->approve($result['COM_DocNo'],$this->table,'COM_DocNo','COM_Status')){
					$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));
					if($result['COM_Status'] == 'Approved'){
						$this->company_model->update_data(array('md5("COM_DocNo"::text)' => $id),array('COM_Active'=>'1','COM_Updates' => '[]'));
					}
					echo json_encode(array('status'=>1,'message'=>$result['COM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel($result['COM_DocNo'],$this->table,'COM_Status','COM_DocNo','tblACC_RPDetails','RPD_PFK_DocNo')){
					echo 1;
				}else{
					echo 0;
				}
			break;
			case 'reject':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->reject($result['COM_DocNo'],$this->table,'COM_DocNo','COM_Status',$this->input->post('DT_Remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id))['COM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel-approval':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel_approval($result['COM_DocNo'],$this->table,'COM_DocNo','COM_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id))['COM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}

			break;
			case 're-open':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id));
				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->re_open($result['COM_DocNo'],$this->table,'COM_DocNo','COM_Status',$this->input->post('remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->company_model->get_spec_data_row(array('md5("COM_DocNo")' => $id))['COM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'COM_DocNo','COM_Active');
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
			                array(
			                     'field'   => 'COM_Id', 
			                     'label'   => 'Company ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_Company.COM_Id]|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'COM_Name', 
			                     'label'   => 'Company Name', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),

			                array(
			                     'field'   => 'COM_Address', 
			                     'label'   => 'Address', 
			                     'rules'   => 'TRIM|max_length[200]'
			                  ),

			                array(
			                     'field'   => 'COM_PhoneNo', 
			                     'label'   => 'Phone #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_FaxNum', 
			                     'label'   => 'Fax #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_BusinessType', 
			                     'label'   => 'Business Type', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                array(
			                     'field'   => 'COM_Tin', 
			                     'label'   => 'Tin #', 
			                     'rules'   => 'TRIM|max_length[12]'
			                  ),

			                array(
			                     'field'   => 'COM_PhilhealthNo', 
			                     'label'   => 'Philhealth #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PagibigNo', 
			                     'label'   => 'Pag-ibig #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_Email', 
			                     'label'   => 'Email', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                array(
			                     'field'   => 'COM_Website', 
			                     'label'   => 'Website', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                array(
			                     'field'   => 'COM_SSSNo', 
			                     'label'   => 'SSS #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_PreparedBy', 
			                     'label'   => 'Prepared By', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_ApprovedBy', 
			                     'label'   => 'Approved By', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_BankAccount', 
			                     'label'   => 'Bank Account', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_WorkDays', 
			                     'label'   => 'Work Days', 
			                     'rules'   => 'TRIM|integer'
			                  )			            
                		),
			'update'	=> array(
								array(
				                     'field'   => 'COM_Id', 
				                     'label'   => 'Company ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_Company.COM_Id.COM_Id.'.$this->input->post('COM_Id').']'
				                 ),
								array(
				                     'field'   => 'COM_Name', 
				                     'label'   => 'Company Name', 
				                     'rules'   => 'TRIM|required'
			                  	),

			                  	array(
				                     'field'   => 'COM_Name', 
				                     'label'   => 'Company Name', 
				                     'rules'   => 'TRIM|required|max_length[100]'
			                  	),

			                array(
			                     'field'   => 'COM_Address', 
			                     'label'   => 'Address', 
			                     'rules'   => 'TRIM|max_length[200]'
			                  ),

			                array(
			                     'field'   => 'COM_PhoneNo', 
			                     'label'   => 'Phone #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_FaxNum', 
			                     'label'   => 'Fax #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_BusinessType', 
			                     'label'   => 'Business Type', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                array(
			                     'field'   => 'COM_Tin', 
			                     'label'   => 'Tin #', 
			                     'rules'   => 'TRIM|max_length[12]'
			                  ),

			                array(
			                     'field'   => 'COM_PhilhealthNo', 
			                     'label'   => 'Philhealth #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PagibigNo', 
			                     'label'   => 'Pag-ibig #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_Email', 
			                     'label'   => 'Email', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                array(
			                     'field'   => 'COM_Website', 
			                     'label'   => 'Website', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                array(
			                     'field'   => 'COM_SSSNo', 
			                     'label'   => 'SSS #', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_PreparedBy', 
			                     'label'   => 'Prepared By', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_ApprovedBy', 
			                     'label'   => 'Approved By', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_BankAccount', 
			                     'label'   => 'Bank Account', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                array(
			                     'field'   => 'COM_PAY_WorkDays', 
			                     'label'   => 'Work Days', 
			                     'rules'   => 'TRIM|integer'
			                  )			            
							),
            );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					'COM_FY_Start'		=> 'null',
					'COM_FY_End'		=> 'null',
					'COM_Currency'		=> 'null'
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

	private function approval_functions($id){

		$this->load->model('app/administration/company_model');
		$this->load->model('app/transaction_module_functions');

		$result = $this->company_model->get_spec_data_row_spec_fields(array('COM_DocNo'),array('md5("COM_DocNo")' => $id));

		$function['functions'] = $this->transaction_module_functions->get_module_functions($this->table,$result['COM_DocNo'],'COM_DocNo','COM_Status','CreatedBy',$this->module_id);
		
		$function['id']		   = $id;
		
		return $this->load->view("templates/approval_functions",$function,true);

	}

	private function _map(&$value){
		
		$value['checkbox']  = $value['COM_Status'] == 'Approved' ? $this->_checkbox($value['id']):'';
		$value['buttons'] 	= $this->_access_inline($value['id']);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id ))),true);
	
	}

	private function _access_inline($id=""){

		$this->load->model('app/administration/user_profile_model');
		return  $this->load->view("templates/access_inline",array('id'		=> $id,
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=>$this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'=>$this->module_id))),true);

	}
	
}
