<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reason extends CI_Controller {
  
  private $module_id = 148;

  private $table 	 = "tblCOM_Reason";

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
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'R_Id');
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
		$data['title'] = "Administration: Reason";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-reason' => array(
						 										'buttons'			=> array('label' =>  $this->_access_header(),'sorts' => true),
															 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'R_Id'				=> array('label' => 'Purpose ID'),
															 	'R_Description'		=> array('label' => 'Description'),
																'R_Active'			=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/reason_model');

		$data = $this->reason_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->reason_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Reason: Add";
      	$this->load->vars($data);

      	$this->load->model('app/administration/module_model');
		$content['module'] = $this->module_model->get_all_data_dropdown();

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);
	
		$data['title'] = "Administration: Reason: Edit";
      	$this->load->vars($data);

      	$this->load->model('app/administration/module_model');
		$content['module'] = $this->module_model->get_all_data_dropdown();
		
		$this->load->model('app/administration/reason_model');
		$content['data'] 		=  $this->reason_model->get_spec_data_row(array('md5("R_Id")' 	=>  $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');

		$content['data']['module']	=  $this->reason_model->get_spec_reason_array_per_module(array('md5("RM_FK_Reason_id")' 	=> $this->input->get('id')));
		
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/reason/update',$content,true)));	
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

		$this->load->model('app/administration/reason_model');

		switch ($this->input->post('type')) {
			case 'add':
			
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['R_Active'] = '1';
						
						$this->reason_model->add_data($this->input->post(NULL,TRUE));

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
						
						$this->load->model('app/administration/reason_model');
						$module = $this->reason_model->get_spec_reason_array_per_module(array('md5("RM_FK_Reason_id")' 	=> $id));
		
						$data['add'] 	= array_diff($this->input->post('RM_FK_Module_id'),array_column($module['data'],'RM_FK_Module_id'));
						$data['delete'] = array_diff(array_column($module['data'],'RM_FK_Module_id'),$this->input->post('RM_FK_Module_id'));
						unset($_POST['RM_FK_Module_id']);
						$data['reason'] 	= $this->input->post(NULL,TRUE);

						$this->reason_model->update_main_data(array('md5("R_Id")' => $id),$data);
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
					
					$this->reason_model->update_data(array('md5("R_Id")' => $value),update_data(array('R_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->reason_model->update_data(array('md5("R_Id")' => $value),update_data(array('R_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->reason_model->delete(array('md5("R_Id")' => $this->input->post('id')));

			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'R_Id','R_Active');
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
			                     'field'   => 'R_Id', 
			                     'label'   => 'Reason ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_Reason.R_Id]|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'R_Description', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_Reason.R_Description]|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'RM_FK_Module_id[]', 
			                     'label'   => 'Module', 
			                     'rules'   => 'required'
			                  ) 
                		),
			'update'	=> array(
								array(
				                     'field'   => 'R_Id', 
				                     'label'   => 'Reason ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_Reason.R_Id.md5("R_Id").'.$uniqid.']|max_length[30]'
				                 ),
				                array(
				                     'field'   => 'R_Description', 
				                     'label'   => 'Description', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_Reason.R_Description.md5("R_Id").'.$uniqid.']|max_length[100]'
				                  ), 
				                array(
				                     'field'   => 'RM_FK_Module_id[]', 
				                     'label'   => 'Module', 
				                     'rules'   => 'required'
			                  	  )  
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
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}
	
}
