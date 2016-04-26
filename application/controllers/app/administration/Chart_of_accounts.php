<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart_of_accounts extends CI_Controller {
  
  private $module_id = 243;

  private $table 	 = "tblACC_ChartAccount";

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
		$data['title'] = "Administration: Chart of Accounts";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-chart-of-accounts' => array(
						 										'buttons'			=> array('label' =>  $this->_access_header(),'sorts' => true),
															 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'CA_Account_id'		=> array('label' => 'Account Code'),
															 	'CA_AccountName'	=> array('label' => 'Account Name'),
																'CA_AccountDesc'	=> array('label' => 'Desciption'),
																'CA_BookType'		=> array('label' => 'Book Type'),
																'CA_Active'			=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function data(){
		
		$this->load->model('app/administration/chart_of_accounts_model');

		$data = $this->chart_of_accounts_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->chart_of_accounts_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Chart of Accounts: Add";
      	$this->load->vars($data);

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),"",true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);
	
		$data['title'] = "Administration: Chart of Accounts: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/chart_of_accounts_model');
		$content['data'] 		=  $this->chart_of_accounts_model->get_spec_data(array('md5("CA_Account_id")' 	=>  $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');

		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/chart-of-accounts/update',$content,true)));	
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

		$this->load->model('app/administration/chart_of_accounts_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['CA_Active'] = '1';
					
					$this->_set_default();
					$this->chart_of_accounts_model->add_data($this->input->post(NULL,TRUE));

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
					unset($_POST['uniqid'],$_POST['CA_Account_id']);
					
					$this->_set_default();
					$this->chart_of_accounts_model->update_data(array('md5("CA_Account_id")' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->chart_of_accounts_model->update_data(array('md5("CA_Account_id")' => $value),update_data(array('CA_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->chart_of_accounts_model->update_data(array('md5("CA_Account_id")' => $value),update_data(array('CA_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->chart_of_accounts_model->delete(array('md5("CA_Account_id")' => $this->input->post('id')));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'CA_Account_id', 
			                     'label'   => 'Account Code', 
			                     'rules'   => 'TRIM|required|is_unique[tblACC_ChartAccount.CA_Account_id]'
			                  ),
			                array(
			                     'field'   => 'CA_AccountName', 
			                     'label'   => 'Account Name', 
			                     'rules'   => 'TRIM|required'
			                  ),

			                array(
			                     'field'   => 'CA_SubAccountOf', 
			                     'label'   => 'Sub Account of', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                 array(
			                     'field'   => 'CA_AccountDesc', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|max_length[200]'
			                  ),

			                 array(
			                     'field'   => 'CA_BookType', 
			                     'label'   => 'Book Type', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                 array(
			                     'field'   => 'CA_FK_Attribute_AccountType_id', 
			                     'label'   => 'Account Type', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                 array(
			                     'field'   => 'CA_AccountLevel', 
			                     'label'   => 'Level', 
			                     'rules'   => 'TRIM|numeric'
			                  ),

			                 array(
			                     'field'   => 'CA_OpeningBalance', 
			                     'label'   => 'Opening Balance', 
			                     'rules'   => 'TRIM|numeric'
			                  ),

			                 array(
			                     'field'   => 'CA_CurrentBalance', 
			                     'label'   => 'Current Balance', 
			                     'rules'   => 'TRIM|numeric'
			                  )

						),
			'update'	=> array(
								array(
			                     'field'   => 'CA_AccountName', 
			                     'label'   => 'Account Name', 
			                     'rules'   => 'TRIM|required'
			                  ),

								array(
			                     'field'   => 'CA_SubAccountOf', 
			                     'label'   => 'Sub Account of', 
			                     'rules'   => 'TRIM|max_length[50]'
			                  ),

			                 array(
			                     'field'   => 'CA_AccountDesc', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|max_length[200]'
			                  ),

			                 array(
			                     'field'   => 'CA_BookType', 
			                     'label'   => 'Book Type', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                 array(
			                     'field'   => 'CA_FK_Attribute_AccountType_id', 
			                     'label'   => 'Account Type', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),

			                 array(
			                     'field'   => 'CA_AccountLevel', 
			                     'label'   => 'Level', 
			                     'rules'   => 'TRIM|numeric'
			                  ),

			                 array(
			                     'field'   => 'CA_OpeningBalance', 
			                     'label'   => 'Opening Balance', 
			                     'rules'   => 'TRIM|numeric'
			                  ),

			                 array(
			                     'field'   => 'CA_CurrentBalance', 
			                     'label'   => 'Current Balance', 
			                     'rules'   => 'TRIM|numeric'
			                  )
						),
            );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					'CA_CurrentBalance'	=> 'numeric',
					'CA_OpeningBalance'	=> 'numeric',
					'CA_AccountLevel'	=> 'numeric',
					'CA_BalanceAsOf'	=> 'null'
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
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}
	
}
