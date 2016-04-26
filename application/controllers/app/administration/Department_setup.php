<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department_setup extends CI_Controller {

  private $module_id = 253;
  
  private $table 	 = "tblCOM_DepartmentClass";

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
		$data['title'] = "Administration: Concerned Deparment Setup";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-category' => array(
						 										'buttons'			=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'DEP_Id'			=> array('label' => 'Department ID'),
																'DEP_Description'	=> array('label' => 'Description'),
																'DEP_Active'		=> array('label' => 'Status')
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/department_setup_model');

		$data = $this->department_setup_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->department_setup_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Deparment Setup: Add";
		$this->load->vars($data);

		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Deparment Setup: Edit";
		$this->load->vars($data);
		
		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();
		
		$this->load->model('app/administration/department_setup_model');
		$content['data'] 		=  $this->department_setup_model->get_spec_data_row(array('md5("DEP_Id")' 	=> $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');
		
		$this->load->model('app/administration/department_setup_model');
		$content['data']['position']	=  $this->department_setup_model->get_spec_location_array(array('md5("DS_FK_Department_id")' 	=> $this->input->get('id')));
		
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/department-setup/update',$content,true)));	
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

		$this->load->model('app/administration/department_setup_model');
		switch ($this->input->post('type')) {
			case 'add':
			
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['DEP_Active'] = '1';
						
						$this->department_setup_model->add_data($this->input->post(NULL,TRUE));

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
						
						$users = $this->department_setup_model->get_spec_location_array(array('md5("DS_FK_Department_id")' 	=> $id));
					
						$data['add'] 	= array_diff($this->input->post('DS_FK_Position_id'),array_column($users,'DS_FK_Position_id'));
						$data['delete'] = array_diff(array_column($users,'DS_FK_Position_id'),$this->input->post('DS_FK_Position_id'));
						unset($_POST['DS_FK_Position_id']);
						$data['position'] 	= $this->input->post(NULL,TRUE);

						$this->department_setup_model->update_main_data(array('md5("DEP_Id")' => $id),$data);
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

					$this->department_setup_model->update_data(array('md5("DEP_Id")' => $value),update_data(array('DEP_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {

					$this->department_setup_model->update_data(array('md5("DEP_Id"::text)' => $value),update_data(array('DEP_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->department_setup_model->delete(array('md5("DEP_Id"::text)' => $this->input->post('id')));

			break;
		}
	}


	private function _map(&$value){
		$value['checkbox']  = $this->_checkbox($value['id']);
		$value['buttons'] 	= $this->_access_inline($value['id']);

		return $value;
	}
	
	private function _checkbox($id=""){
		return '<input type="checkbox" class="doc" id="'.$id.'" />';
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'DEP_Id', 
			                     'label'   => 'Department Id', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_DepartmentClass.DEP_Id]'
			                  ),
			                array(
			                     'field'   => 'DEP_Description', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_DepartmentClass.DEP_Description]|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'DS_FK_Position_id[]', 
			                     'label'   => 'Positions', 
			                     'rules'   => 'required'
			                  ) 
                		),
			'update'	=> array(
								array(
				                     'field'   => 'DEP_Id', 
				                     'label'   => 'Department Id', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_DepartmentClass.DEP_Id.md5("DEP_Id").'.$uniqid.']'
				                 ),
				                array(
				                     'field'   => 'DEP_Description', 
				                     'label'   => 'Description', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_DepartmentClass.DEP_Description.md5("DEP_Id").'.$uniqid.']|max_length[100]'
				                  ), 
				                array(
				                     'field'   => 'DS_FK_Position_id[]', 
				                     'label'   => 'Positions', 
				                     'rules'   => 'required'
			                  	  )    
								)
            );
		return $config[$type];
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	


	private function _functions(){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'=> $this->module_id))),true);
	
	}

	private function _access_inline($id=""){

		$this->load->model('app/administration/user_profile_model');
		return  $this->load->view("templates/access_inline",array('id'=>$id,'access' => $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'=>$this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'=>$this->module_id))),true);

	}

	// private function _navigation(){

	// }
	
}
