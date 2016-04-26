<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_category extends CI_Controller {

  private $module_id = 250;
  
  private $table 	 = "tblINV_SubCategory";

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
		$data['title'] = "Administration: Sub Category";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-sub-category' => array(
						 										'buttons'			=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'SC_Id'				=> array('label' => 'Sub Category ID'),
																'SC_Description'	=> array('label' => 'Description'),
																'CAT_Desc'	=> array('label' => 'Category'),
																'SC_Active'			=> array('label' => 'Active'),
																)
						 					)
						 
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/sub_category_model');

		$data = $this->sub_category_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->sub_category_model->record_count());
		}

		echo json_encode($result);

	}

	public function json($id){
		$this->load->model('app/administration/sub_category_model');
		echo json_encode($this->sub_category_model->get_spec_data_array(array('SC_FK_Category_id'=> $id))['data']);
	}

	public function add(){
		
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Sub Category: Add";
      	$this->load->vars($data);
   
		$this->load->model('app/administration/category_model');
		$content['category'] 	= $this->category_model->get_spec_data_array(array("CAT_Active"=>'1'));
		
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}


	public function update($id=""){
		
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Sub Category: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/category_model');
		$content['category'] 	= $this->category_model->get_spec_data_array(array("CAT_Active"=>'1'));
		
		$this->load->model('app/administration/sub_category_model');

		$content['data']		= $this->sub_category_model->get_spec_data_row(array('md5("SC_Id")' => $this->input->get('id')));
		$content['data']['id']	= $this->input->get('id');
			
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/sub-category/update',$content,true)));	
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

		$this->load->model('app/administration/sub_category_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['SC_Active'] 		= '1';
					
					$this->sub_category_model->add_data($this->input->post(NULL,TRUE));

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
					unset($_POST['uniqid']);
					
					$this->sub_category_model->update_data(array('md5("SC_Id"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->sub_category_model->update_data(array('md5("SC_Id"::text)' => $value),update_data(array('SC_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->sub_category_model->update_data(array('md5("SC_Id"::text)' => $value),update_data(array('SC_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->sub_category_model->delete(array('md5("SC_Id"::text)' => $this->input->post('id')));

			break;

		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' 		=> array(
			                array(
		                     'field'   => 'SC_Id', 
		                     'label'   => 'Sub Category ID', 
		                     'rules'   => 'TRIM|required|is_unique[tblINV_Category.CAT_Id]'
			                 ),
			                array(
		                     'field'   => 'SC_Description', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|is_unique[tblINV_SubCategory.SC_Description]|max_length[100]'
		                  	),
							array(
		                     'field'   => 'SC_FK_Category_id', 
		                     'label'   => 'Category', 
		                     'rules'   => 'TRIM|required'
		                  	)
			            ),
			'update'	=> array(
							array(
		                     'field'   => 'SC_Id', 
		                     'label'   => 'Category ID', 
		                     'rules'   => 'TRIM|required|is_unique2[tblINV_SubCategory.SC_Id.md5("SC_Id").'.$uniqid.']'
			                 ),
							array(
		                     'field'   => 'SC_Description', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|max_length[100]|is_unique[tblINV_SubCategory.SC_Description]'
		                  	),
							array(
		                     'field'   => 'SC_FK_Category_id', 
		                     'label'   => 'Category', 
		                     'rules'   => 'TRIM|required'
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
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}
	
}
