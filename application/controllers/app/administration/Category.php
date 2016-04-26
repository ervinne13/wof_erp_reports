<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

  private $module_id = 174;
  
  private $table 	 = "tblINV_Category";

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
		$data['title'] = "Administration: Category";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-category' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'CAT_Id'		=> array('label' => 'Category ID'),
																'CAT_Desc'		=> array('label' => 'Description'),
																// 'CAT_ItemBatch'	=> array('label' => 'Item Batch'),
																'CAT_Active'	=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/category_model');

		$data = $this->category_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->category_model->record_count());
		}

		echo json_encode($result);

	}

	public function json($id){
		$this->load->model('app/administration/category_model');
		echo json_encode($this->category_model->get_spec_data_array(array('CAT_FK_ItemType_id' => $id))['data']);
	}

	public function add(){
		
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Category: Add";
      	$this->load->vars($data);
   
		$this->load->model('app/administration/item_type_model');
		$content['itemtype'] 	= $this->item_type_model->get_spec_data_array(array('IT_Active' => '1'));
		
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}


	public function update($id=""){
		
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Category: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/item_type_model');
		$content['itemtype'] 	= $this->item_type_model->get_spec_data_array(array('IT_Active' => '1'));
		
		$this->load->model('app/administration/category_model');

		$content['data']		= $this->category_model->get_spec_data_row(array('md5("CAT_Id")' => $this->input->get('id')));
		$content['data']['id']	= $this->input->get('id');
			
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/category/update',$content,true)));	
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

		$this->load->model('app/administration/category_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['CAT_Active'] 		= '1';
					
					$this->category_model->add_data($this->input->post(NULL,TRUE));

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
					
					$this->category_model->update_data(array('md5("CAT_Id"::text)' => $id),$this->input->post(NULL,TRUE));
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
					
					$this->category_model->update_data(array('md5("CAT_Id"::text)' => $value),array('CAT_Active' => '1'));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->category_model->update_data(array('md5("CAT_Id"::text)' => $value),array('CAT_Active' => '0'));

				}
			break;
			case 'delete':
				
				echo  $this->category_model->delete(array('md5("CAT_Id"::text)' => $this->input->post('id')));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' 		=> array(
			                array(
		                     'field'   => 'CAT_Id', 
		                     'label'   => 'Category ID', 
		                     'rules'   => 'TRIM|required|is_unique[tblINV_Category.CAT_Id]'
			                 ),
			                array(
		                     'field'   => 'CAT_Desc', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|max_length[100]|is_unique[tblINV_Category.CAT_Desc]'
		                  	),
							array(
		                     'field'   => 'CAT_FK_ItemType_id', 
		                     'label'   => 'Item Type', 
		                     'rules'   => 'TRIM|required'
		                  	)
			            ),
			'update'	=> array(
							array(
		                     'field'   => 'CAT_Id', 
		                     'label'   => 'Category ID', 
		                     'rules'   => 'TRIM|required|is_unique2[tblINV_Category.CAT_Id.md5("CAT_Id").'.$uniqid.']'
			                 ),
							array(
		                     'field'   => 'CAT_Desc', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|max_length[100]|is_unique2[tblINV_Category.CAT_Desc.md5("CAT_Id").'.$uniqid.']'
		                  	),
							array(
		                     'field'   => 'CAT_FK_ItemType_id', 
		                     'label'   => 'Item Type', 
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
