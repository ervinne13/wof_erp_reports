<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_access extends CI_Controller {
  
  private $module_id = 241;

  private $table 	 = "tblCOM_CompanyAccess";

  public function __construct()
    {
        parent::__construct();
      	
      	if(!is_logged_in()['status']){
          redirect(base_url());
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
		$data['title'] = "Administration: Company Access";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-cost-center-profit' => array(
								 										'buttons'		=> array('label' =>  $this->_access_header(),'sorts' => true),
																	 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
																	 	'User_id'		=> array('label' => 'User'),
																		'Location'		=> array('label' => 'Location'),
																		'CA_Active'		=> array('label' => 'Active'),
																		)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/company_access_model');

		$data = $this->company_access_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->company_access_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}


		$data['title'] = "Administration: Company Access: Add";
      	$this->load->vars($data);

		$this->load->model('app/administration/user_model');
		$content['user'] = $this->user_model->get_all_data();

		$this->load->model('app/administration/location_model');
		$content['location'] = $this->location_model->get_all_data();

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Company Access: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/user_model');
		$content['user'] = $this->user_model->get_all_data();

		$this->load->model('app/administration/location_model');
		$content['location'] = $this->location_model->get_all_data();

		$this->load->model('app/administration/company_access_model');
		$content['data'] 		=  $this->company_access_model->get_spec_data(array('MD5(concat("CA_FK_User_id","CA_FK_Location_id"))' 	=> $this->input->get('id')));
		$content['data']['id'] 	=  $this->input->get('id');
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/company-access/update',$content,true)));	
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

		$this->load->model('app/administration/company_access_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['CA_Active'] = '1';
					
					$this->company_access_model->add_data($this->input->post(NULL,TRUE));

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
					
					$this->company_access_model->update_data(array('MD5(concat("CA_FK_User_id","CA_FK_Location_id"))' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->company_access_model->update_data(array('MD5(concat("CA_FK_User_id","CA_FK_Location_id"))' => $value),update_data(array('CA_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->company_access_model->update_data(array('MD5(concat("CA_FK_User_id","CA_FK_Location_id"))' => $value),update_data(array('CA_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->company_access_model->delete(array('MD5(concat("CA_FK_User_id","CA_FK_Location_id"))' => $this->input->post('id')));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'CA_FK_User_id', 
			                     'label'   => 'User', 
			                     'rules'   => 'TRIM|required|double_unique[tblCOM_CompanyAccess.CA_FK_User_id.CA_FK_Location_id.'.$_POST['CA_FK_Location_id'].'.Location]'
			                  ),
			                array(
			                     'field'   => 'CA_FK_Location_id', 
			                     'label'   => 'Location', 
			                     'rules'   => 'TRIM|required|double_unique[tblCOM_CompanyAccess.CA_FK_Location_id.CA_FK_User_id.'.$_POST['CA_FK_User_id'].'.User]'
			                  ),
                			),
			'update'	=> array(
								array(
			                     'field'   => 'CA_FK_User_id', 
			                     'label'   => 'User', 
			                     'rules'   => 'TRIM|required|double_unique2[tblCOM_CompanyAccess.CA_FK_User_id.CA_FK_Location_id.'.$_POST['CA_FK_Location_id'].'.MD5(concat("CA_FK_User_id","CA_FK_Location_id")).'.$uniqid.'.Location]'
			                  ),
			                array(
			                     'field'   => 'CA_FK_Location_id', 
			                     'label'   => 'Location', 
			                     'rules'   => 'TRIM|required|double_unique2[tblCOM_CompanyAccess.CA_FK_Location_id.CA_FK_User_id.'.$_POST['CA_FK_User_id'].'.MD5(concat("CA_FK_User_id","CA_FK_Location_id")).'.$uniqid.'.User]'
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
