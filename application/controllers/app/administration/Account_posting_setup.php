<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_posting_setup extends CI_Controller {
  
  private $module_id = 244;

  private $table 	 = "tblACC_PostingAccountSetup";

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
		$data['title'] = "Administration: Account Posting Setup";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-account-posting-setup' => array(
								 										'buttons'	=> array('label' =>  $this->_access_header(),'sorts' => true),
																	 	'checkbox'	=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
																	 	'Posting'	=> array('label' => 'User'),
																		'Account'	=> array('label' => 'Location'),
																		'AS_Active'	=> array('label' => 'Active'),
																		)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/account_posting_setup_model');

		$data = $this->account_posting_setup_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->module_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}


		$data['title'] = "Administration: Account Posting Setup: Add";
      	$this->load->vars($data);

		$this->load->model('app/administration/posting_group_model');
		$content['posting'] = $this->posting_group_model->get_all_data();

		$this->load->model('app/administration/chart_of_accounts_model');
		$content['account'] = $this->chart_of_accounts_model->get_all_data();

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Account Posting Setup: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/posting_group_model');
		$content['posting'] = $this->posting_group_model->get_all_data();

		$this->load->model('app/administration/chart_of_accounts_model');
		$content['account'] = $this->chart_of_accounts_model->get_all_data();

		$this->load->model('app/administration/account_posting_setup_model');
		$content['data'] 		=  $this->account_posting_setup_model->get_spec_data(array('MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id"))' 	=> $this->input->get('id')));
		$content['data']['id'] 	=  $this->input->get('id');
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/account-posting-setup/update',$content,true)));	
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

		$this->load->model('app/administration/account_posting_setup_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['AS_Active'] = '1';
					
					$this->account_posting_setup_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			// print_r($_POST);
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('update',$id))){
					unset($_POST['uniqid'],$_POST['COM_Id']);
					
					$this->account_posting_setup_model->update_data(array('MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id"))' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->account_posting_setup_model->update_data(array('MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id"))' => $value),update_data(array('AS_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->account_posting_setup_model->update_data(array('MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id"))' => $value),update_data(array('AS_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->account_posting_setup_model->delete(array('MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id"))' => $this->input->post('id')));

			break;

		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'AS_PKFK_PostingGroup_id', 
			                     'label'   => 'Posting Group', 
			                     'rules'   => 'TRIM|required|double_unique[tblACC_PostingAccountSetup.AS_PKFK_PostingGroup_id.AS_PKFK_Account_id.'.$_POST['AS_PKFK_Account_id'].'.Account]'
			                  ),
			                array(
			                     'field'   => 'AS_PKFK_Account_id', 
			                     'label'   => 'Account', 
			                     'rules'   => 'TRIM|required|double_unique[tblACC_PostingAccountSetup.AS_PKFK_Account_id.AS_PKFK_PostingGroup_id.'.$_POST['AS_PKFK_PostingGroup_id'].'.Posting Group]'
			                  ),
                			),
			'update'	=> array(
								array(
			                     'field'   => 'AS_PKFK_PostingGroup_id', 
			                     'label'   => 'Posting Group', 
			                     'rules'   => 'TRIM|required|double_unique2[tblACC_PostingAccountSetup.AS_PKFK_PostingGroup_id.AS_PKFK_Account_id.'.$_POST['AS_PKFK_Account_id'].'.MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id")).'.$uniqid.'.Account]'
			                  ),
			                array(
			                     'field'   => 'AS_PKFK_Account_id', 
			                     'label'   => 'Account', 
			                     'rules'   => 'TRIM|required|double_unique2[tblACC_PostingAccountSetup.AS_PKFK_Account_id.AS_PKFK_PostingGroup_id.'.$_POST['AS_PKFK_PostingGroup_id'].'.MD5(concat("AS_PKFK_PostingGroup_id","AS_PKFK_Account_id")).'.$uniqid.'.Posting Group]'
			                  ),
							),
            );
		return $config[$type];
	}


	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	



	private function _checkbox($id=""){
		return '<input type="checkbox" class="doc" id="'.$id.'" />';
	}


	private function _map(&$value){
		
		$value['checkbox']  = $this->_checkbox($value['id']);
		$value['buttons'] 	= $this->_access_inline($value['id']);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
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
