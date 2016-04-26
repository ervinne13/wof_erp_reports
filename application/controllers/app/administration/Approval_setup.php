<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_setup extends CI_Controller {

  private $module_id = 248;
  
  private $table 	 = "tblCOM_ApprovalSetup";

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
		$data['title'] = "Administration: Approval Setup";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-category' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'NS_Id'			=> array('label' => 'No Series ID'),
																'M_Description'	=> array('label' => 'Module'),
																'setup'			=> array('label' => 'Setup','sorts' => true),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/approval_setup_model');

		$data = $this->approval_setup_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->approval_setup_model->record_count());
		}

		echo json_encode($result);

	}

	public function update($id=""){
		
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Approval Setup: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();

		$this->load->model('app/administration/approval_setup_model');

		$content['data']		= $this->approval_setup_model->get_spec_data(array('md5("NS_Id")' => $this->input->get('id')));
		$content['data']['id']	= $this->input->get('id');
			
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/approval-setup/update',$content,true)));	
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

		$this->load->model('app/administration/approval_setup_model');

		switch ($this->input->post('type')) {
			
			case 'update':
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				if((count($_POST)==1) || $this->_validate($this->_validation_config('update',$id))){
					unset($_POST['uniqid']);
					
					$this->_set_default();
				
					$this->approval_setup_model->update_data(array('md5("AS_FK_NS_id"::text)' => $id),$this->input->post(NULL,TRUE));
					$this->load->model('app/administration/user_record_lock_model');
					$this->user_record_lock_model->record_unlock($id, $this->table);
					
					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'update'	=> array()
            );
		if($this->input->post('pos')){

				foreach ($this->input->post('pos') as $key => $value) {
					  array_push($config[$type], 
					  						array(
					  							'field'   => 'pos[' . $key . '][AS_FK_Position_id]', 
							                    'label'   => 'Position', 
							                    'rules'   => 'TRIM|required'
					  						),
						  					array(
						  						'field'   => 'pos[' . $key . '][AS_Amount]', 
							                    'label'   => 'Amount', 
							                    'rules'   => 'TRIM|numeric'
						  					)
					  			);
				}
			}
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array();
		if($this->input->post('pos')){
			foreach ($this->input->post('pos') as $key => $value) {
						$_POST['pos'][$key]['AS_Amount'] = $_POST['pos'][$key]['AS_Amount'] ? $_POST['pos'][$key]['AS_Amount']:0;
					}
		}

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
		$value['setup'] 	= $this->_setup($value['setup']);

		return $value;
	}

	private function _setup($setup){
		if($setup){
			$data['setup'] = json_decode($setup);
			return $this->load->view('app/administration/approval-setup/setup',$data,true);
		}else{
			return 'No Setup Available';
		}
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
