<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buyer_setup extends CI_Controller {

  private $module_id = 249;
  
  private $table 	 = "tblCOM_BuyerClass";

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
		$data['title'] = "Administration: Buyer Setup";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-category' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'B_Id'			=> array('label' => 'Buyer Class ID'),
																'B_Description'	=> array('label' => 'Description'),
																'B_Active'		=> array('label' => 'Status'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/buyer_setup_model');

		$data = $this->buyer_setup_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->buyer_setup_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Buyer Setup: Add";
		$this->load->vars($data);

		$this->load->model('app/administration/user_model');
		$content['user'] = $this->user_model->get_spec_data_array(array('U_Status'=>'1'));

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Buyer Setup: Edit";
		$this->load->vars($data);
		
		$this->load->model('app/administration/user_model');
		$content['user'] = $this->user_model->get_spec_data_array(array('U_Status'=>'1'));
		
		$this->load->model('app/administration/buyer_setup_model');
		$content['data'] 		=  $this->buyer_setup_model->get_spec_data_row(array('md5("B_Id")' 	=> $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');
		
		$this->load->model('app/administration/buyer_setup_model');
		$content['data']['users']	=  $this->buyer_setup_model->get_spec_location_array(array('md5("BS_FK_BuyerClass_id")' 	=> $this->input->get('id')));
		
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/buyer-setup/update',$content,true)));	
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

		$this->load->model('app/administration/buyer_setup_model');
		switch ($this->input->post('type')) {
			case 'add':
			
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['B_Active'] = '1';
						
						$this->buyer_setup_model->add_data($this->input->post(NULL,TRUE));

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
						
						$users = $this->buyer_setup_model->get_spec_location_array(array('md5("BS_FK_BuyerClass_id")' 	=> $id));
					
						$data['add'] 	= array_diff($this->input->post('BS_FK_User_id'),array_column($users,'BS_FK_User_id'));
						$data['delete'] = array_diff(array_column($users,'BS_FK_User_id'),$this->input->post('BS_FK_User_id'));
						unset($_POST['BS_FK_User_id']);
						$data['user'] 	= $this->input->post(NULL,TRUE);

						$this->buyer_setup_model->update_main_data(array('md5("B_Id")' => $id),$data);
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

					$this->buyer_setup_model->update_data(array('md5("B_Id")' => $value),update_data(array('B_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {

					$this->buyer_setup_model->update_data(array('md5("B_Id"::text)' => $value),update_data(array('B_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->buyer_setup_model->delete(array('md5("B_Id"::text)' => $this->input->post('id')));
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
			                     'field'   => 'B_Id', 
			                     'label'   => 'Buyer Class Id', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_BuyerClass.B_Id]'
			                  ),
			                array(
			                     'field'   => 'B_Description', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_BuyerClass.B_Description]|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'BS_FK_User_id[]', 
			                     'label'   => 'Buyers', 
			                     'rules'   => 'required'
			                  ) 
                		),
			'update'	=> array(
								array(
				                     'field'   => 'B_Id', 
				                     'label'   => 'Buyer Class Id', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_BuyerClass.B_Id.md5("B_Id").'.$uniqid.']'
				                 ),
				                array(
				                     'field'   => 'B_Description', 
				                     'label'   => 'Description', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_BuyerClass.B_Description.md5("B_Id").'.$uniqid.']|max_length[100]'
				                  ), 
				                array(
			                     'field'   => 'BS_FK_User_id[]', 
			                     'label'   => 'Buyers', 
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
