<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Identifier extends CI_Controller {

  private $module_id = 251;
  
  private $table 	 = "tblINV_Identifier";

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
		$data['title'] = "Administration: Identifier";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-identifier' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'ID_Id'			=> array('label' => 'Identifier ID'),
																'ID_Description'=> array('label' => 'Description'),
																'ID_Active'		=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/identifier_model');

		$data = $this->identifier_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->identifier_model->record_count());
		}

		echo json_encode($result);

	}

	public function json(){

		$this->load->model('app/administration/identifier_setup_model');
		$identifier = $this->identifier_setup_model->get_all_spec_data_json($this->input->get('cat'),$this->input->get('sub'));
		echo json_encode($this->load->view('app/administration/item-master/identifier',$identifier,true));
	}

	public function add(){
		
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Identifier: Add";
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

		$data['title'] = "Administration: Identifier: Edit";
      	$this->load->vars($data);
 
		$this->load->model('app/administration/identifier_model');

		$content['data']		= $this->identifier_model->get_spec_data_row(array('md5("ID_Id")' => $this->input->get('id')));
		$content['data']['id']	= $this->input->get('id');
			
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/identifier/update',$content,true)));	
			$this->load->view("templates/container", $page);
		}else{
			redirect(site_url()."app/error");
		}
	}
	
	public function view($view=""){

		switch ($view) {
			case '':
					$data['title'] = "Administration: Identifier: View";
			      	$this->load->vars($data);

			      	$this->load->model('app/administration/identifier_model');
					$content = array('function'=> $this->_functions_inside(),
									 'table'  => array('tbl-identifier-details' => array(
									 										'buttons'			=> array('label' => $this->_access_header_inside($this->input->get('id')),'sorts' => true),
																		 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
																		 	'IDD_Description'	=> array('label' => 'Description'),
																		 	'subcat'			=> array('label' => 'Sub Category'),
																			'IDD_Active'		=> array('label' => 'Active'),
																			)
									 					),
									'data'		=> $this->identifier_model->get_spec_data_row(array('md5("ID_Id")' => $this->input->get('id'))),
									'id'		=> $this->input->get('id')
									);
				
					$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/identifier/view',$content,true)));	

					$this->load->view("templates/container", $page);
				break;
			
			case 'add':
					if(!check_access($this->module_id,'Add')){
						redirect(site_url()."app/error");
					}

					$data['title'] = "Administration: Identifier: Details: Add";
			      	$this->load->vars($data);
					
					$this->load->model('app/administration/sub_category_model');
					$content['subcategory'] = $this->sub_category_model->get_spec_data_array(array("SC_Active"=>'1'));
					$content['id']			= $this->input->get('id');
					$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/identifier/details-add',$content,true)));	

					$this->load->view("templates/container", $page);
				break;
			case 'update':
					if(!check_access($this->module_id,'Edit')){
						redirect(site_url()."app/error");
					}

					$this->load->model('app/administration/user_record_lock_model');
					$this->user_record_lock_model->record_lock($this->input->get('id'), 'tblINV_IdentifierDetails');

					$data['title'] = "Administration: Identifier: Details: Update";
			      	$this->load->vars($data);


					$this->load->model('app/administration/sub_category_model');
					$content['subcategory'] = $this->sub_category_model->get_spec_data_array(array("SC_Active"=>'1'));
					
			      	$this->load->model('app/administration/identifier_details_model');
					$content['data'] = $this->identifier_details_model->get_spec_data(array('md5("IDD_Id"::text)' => $this->input->get('id')));
					
					if(!empty($content['data'])){
						$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/identifier/details-update',$content,true)));	
						$this->load->view("templates/container", $page);
					}else{
						redirect(site_url()."app/error");
					}
				break;
			default:
				redirect(site_url()."app/error");
				break;
		}
		

	}

	public function details_data(){
		$this->load->model('app/administration/identifier_details_model');

		$data = $this->identifier_details_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map_details'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->identifier_details_model->record_count($this->input->get('id')));
		}
		echo json_encode($result);
	}

	public function back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($pk, $this->table);

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3));
	}

	public function dback(){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($this->input->get('mid'), 'tblINV_IdentifierDetails');

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3).'/view/?id='.$this->input->get('id'));
	}

	public function getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'CAT_Id');
		if($data['rows'] == 0){
			echo json_encode(array('rows'=>$data['rows']));
		}else if($data['rows'] == 1){
			echo json_encode(array('rows'=>$data['rows'],'data'=> $data['data'][0]['NS_Id'].'-'.$data['data'][0]['nsnum'],'uniqid' => $data['data'][0]['uniq']));
		}else{
			echo json_encode(array('rows'=>$data['rows']));
		}
	}
	
	public function getseries_res(){
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id);
		$this->load->view('app/administration/no-series/series',$data);
	}

	public function process(){

		$this->load->model('app/administration/identifier_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['ID_Active'] 		= '1';
					
					$this->identifier_model->add_data($this->input->post(NULL,TRUE));

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
					
					$this->identifier_model->update_data(array('md5("ID_Id"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->identifier_model->update_data(array('md5("ID_Id"::text)' => $value),update_data(array('ID_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->identifier_model->update_data(array('md5("ID_Id"::text)' => $value),update_data(array('ID_Active' => '0')));

				}
			break;
			case 'activate-det':
				$id = json_decode($this->input->post('id'));
				$this->load->model('app/administration/identifier_details_model');
				foreach ($id as $key => $value) {
					
					$this->identifier_details_model->update_data(array('md5("IDD_Id"::text)' => $value),update_data(array('IDD_Active' => '1')));

				}
			break;
			case 'deactivate-det':
				$id = json_decode($this->input->post('id'));
				$this->load->model('app/administration/identifier_details_model');
				foreach ($id as $key => $value) {
					
					$this->identifier_details_model->update_data(array('md5("IDD_Id"::text)' => $value),update_data(array('IDD_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->identifier_model->delete(array('md5("ID_Id"::text)' => $this->input->post('id')));

			break;
			case 'delete-details':
				$this->load->model('app/administration/identifier_details_model');
				echo  $this->identifier_details_model->delete(array('md5("IDD_Id"::text)' => $this->input->post('id')));

			break;
			case 'add-details':
				unset($_POST['type']);
				if($this->_validate($this->_validation_config('add-details'))){
					$this->load->model('app/administration/identifier_details_model');
					$_POST['IDD_Active'] 		= '1';

					$identifier = $this->identifier_model->get_spec_data_row(array('md5("ID_Id")' => $this->input->post('IDD_FK_Identifier_id')));

					$_POST['IDD_FK_Identifier_id'] = $identifier['ID_Id']; 
					$this->identifier_details_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update-details':
				$id = $this->input->post('uniqid');
				unset($_POST['type']);
				if($this->_validate($this->_validation_config('update-details',$id))){
					unset($_POST['uniqid'],$_POST['uniqfid']);
					$this->load->model('app/administration/identifier_details_model');
					$this->identifier_details_model->update_data(array('md5("IDD_Id"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
					$this->load->model('app/administration/user_record_lock_model');
					$this->user_record_lock_model->record_unlock($id, $this->table);
					
					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'ID_Id','ID_Active');
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
			'add' 		=> array(
			                array(
		                     'field'   => 'ID_Id', 
		                     'label'   => 'Identifier ID', 
		                     'rules'   => 'TRIM|required|is_unique[tblINV_Identifier.ID_Id]'
			                ),
			                array(
		                     'field'   => 'ID_Description', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|max_length[100]'
		                  	)
			            ),
			'update'	=> array(
							array(
		                     'field'   => 'ID_Id', 
		                     'label'   => 'Identifier ID', 
		                     'rules'   => 'TRIM|required|is_unique2[tblINV_Identifier.ID_Id.md5("ID_Id").'.$uniqid.']'
			                ),
							array(
		                     'field'   => 'ID_Description', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|max_length[100]'
		                  	)
						),
			'add-details'=> array(
							array(
		                     'field'   => 'IDD_Description', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required'
			              	 ),
							array(
		                     'field'   => 'IDD_FK_SubCategory_id', 
		                     'label'   => 'Sub Category', 
		                     'rules'   => 'TRIM|required'
			               )
						),
			'update-details'=> array(
							array(
		                     'field'   => 'IDD_Description', 
		                     'label'   => 'Description', 
		                     'rules'   => 'TRIM|required|is_unique4[tblINV_IdentifierDetails.IDD_Description.md5("IDD_Id"::text).'.$uniqid.'.md5("IDD_FK_Identifier_id").'.$this->input->post('uniqfid').']'
			                ),
							array(
		                     'field'   => 'IDD_FK_SubCategory_id', 
		                     'label'   => 'Sub Category', 
		                     'rules'   => 'TRIM|required'
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

	private function _map_details(&$value){

		$value['checkbox']  = $this->_checkbox($value['id']);
		$value['buttons'] 	= $this->_access_inline_inside($value['id']);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
	}

	private function _functions_inside($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_inside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
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

	private function _access_header_inside($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline_inside",array('id'		=> $id,
																		 'access' 	=> $this->user_profile_model->get_module_access_per_pos_header_inside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}

	private function _access_inline_inside($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline_inside",array('id'		=> $id,
																		 'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_inside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}
	
}
