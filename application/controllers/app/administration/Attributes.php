<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attributes extends CI_Controller {

  private $table 	 = "tblCOM_AttributeDetail";

  public function __construct()
    {
        parent::__construct();
        $this->load->helper('attribute_check_helper');

      	if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }

    private function _settings(){

       	$data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');
      	$this->load->vars($data);
      	$page 		 	= array('header'	=> $this->load->view("templates/header","",true),
      							'footer'	=> $this->load->view("templates/footer","",true),
							  	'navs'		=> $this->load->view('templates/side-nav',"",true),
							  	'head'		=> $this->load->view("templates/head-nav","",true),
							  );
      	return $page;

    }

    public function _remap(){

    	switch ($this->uri->segment(4)) {
			case 'add':
				$this->_add($this->uri->segment(4).'/add');
			break;
			case 'update':
				$this->_update($this->uri->segment(4).'/update');
			break;
			case 'back':
				$this->_back($this->uri->segment(5));
			break;
			case 'data':
				$this->_data($this->uri->segment(5));
			break;
			case 'process':
				$this->_process();
			break;
			case 'getseries':
				$this->_getseries();
			break;
			case 'getseries_res':
				$this->_getseries_res($this->uri->segment(5));
			break;
			case 'getseries_update':
				$this->_getseries_update($this->input->get('extra'));
			break;
			case '':
				redirect(site_url()."app/error");
			break;
			default: 
				$this->_type($this->uri->segment(5));
		}
    }
	private function _type($id)
	{	
		$data['title'] = "Attribute: ". check_attribute($this->uri->segment(4));
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-attributes' => array(
	 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
										 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
										 	'AD_Code'		=> array('label' => 'Code'),
											'AD_Desc'		=> array('label' => 'Description'),
											'AD_Active'		=> array('label' => 'Active'),
											)
						 				)
						);
		$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/attributes/index',$content,true)));	

		$this->load->view("templates/container", $page);

	}

	private function _data($id){

		$this->load->model('app/administration/attribute_model');

		$data = $this->attribute_model->table_data($this->input->get(),$id);

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->attribute_model->record_count());
		}

		echo json_encode($result);

	}
	

	private function _add(){
		
		if(!check_access($this->uri->segment(5),'Add')){
			redirect(site_url()."app/error");
		}

		$data['title'] = "Attribute: ". check_attribute($this->uri->segment(5)) . ": Add";
      	$this->load->vars($data);

		$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/attributes/add',"",true)));	

		$this->load->view("templates/container", $page);

	}

	private function _update(){

			if(!check_access($this->uri->segment(5),'Edit')){
				redirect(site_url()."app/error");
			}

			$this->load->model('app/administration/user_record_lock_model');
			$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

			$this->load->model('app/administration/attribute_model');

			$data['title'] = "Attribute: ". check_attribute($this->uri->segment(5)) . ": Edit";
      		$this->load->vars($data);

			$content['data'] 		= $this->attribute_model->get_spec_data_attribute($this->input->get('id'));
			$content['data']['id']	= $this->input->get('id');
			if(!empty($content['data'])){
				$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/attributes/update',$content,true)));	
				$this->load->view("templates/container", $page);
			}else{
				redirect(site_url()."app/error");
			}

	}

	private function _back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($this->input->get('id'), $this->table);

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$pk);
	}

	public function _getseries_update($id){
    	$this->load->model('app/administration/no_series_model');
    	echo json_encode($this->no_series_model->getseries_update($id));
    }

	public function _getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->input->get('extra'),$this->table,'AD_Code',array('AD_FK_Code'=>$this->input->get('extra')));
		if($data['rows'] == 0){
			echo json_encode(array('rows'=>$data['rows']));
		}else if($data['rows'] == 1){
			echo json_encode(array('rows'=>$data['rows'],'data'=> $data['data'][0]['NS_Id'].'-'.$data['data'][0]['nsnum'],'uniqid' => $data['data'][0]['uniq'].'-'.$this->input->get('extra')));
		}else{
			echo json_encode(array('rows'=>$data['rows']));
		}
	}
	
	public function _getseries_res($id){
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($id);
		$this->load->view('app/administration/no-series/series',$data);
	}

	private function _process(){

		$this->load->model('app/administration/attribute_model');
		
		switch ($this->input->post('type')) {
			case 'add':

			unset($_POST['type']);

				//$_POST['AD_Code'] = $this->sequence->next_attr_id($_POST['AD_FK_Code']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['AD_Active'] = '1';

					$this->attribute_model->add_data($this->input->post(NULL,TRUE));

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

					$this->attribute_model->update_data(array('md5("AD_Code")||'."'-'".'||"AD_FK_Code"' => $id),update_data($this->input->post(NULL,TRUE)));

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
					
					$this->attribute_model->update_data(array('md5("AD_Code")||'."'-'".'||"AD_FK_Code"' => $value),update_data(array('AD_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				
				foreach ($id as $key => $value) {
					
					$this->attribute_model->update_data(array('md5("AD_Code")||'."'-'".'||"AD_FK_Code"' => $value),update_data(array('AD_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->attribute_model->delete(array('md5("AD_Code")||'."'-'".'||"AD_FK_Code"' => $this->input->post('id')));

			break;
			case 'docseries':
				
				unset($_POST['type']);
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'AD_Code','AD_Active',array('AD_FK_Code'=>$this->input->post('extra')));
				$this->load->model('app/administration/user_record_lock_model');
				$this->user_record_lock_model->record_unlock($data['id'], $this->table);
				
				if($data){
					echo json_encode(array('result' => 1,'data'=>$data['NS_Id'].'-'.$data['NS_LastNoUsed'],'uniqid'=>$data['id'].'-'.$this->input->post('extra')));
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
						                     'field'   => 'AD_Code', 
						                     'label'   => 'Code', 
						                     'rules'   => 'TRIM|required|is_uniq_attr['.$this->input->post('AD_FK_Code').']'
							                 ),
						                array(
						                     'field'   => 'AD_Desc', 
						                     'label'   => 'Description', 
						                     'rules'   => 'TRIM|required|max_length[50]'
						                  ),
						            
				                		),
					'update'	=> array(
										array(
						                     'field'   => 'AD_Code', 
						                     'label'   => 'Code', 
						                     'rules'   => 'TRIM|required|is_uniq_attr2['.$this->input->post('AD_FK_Code').'.'.$uniqid.']'
							                 ),
						                array(
						                     'field'   => 'AD_Desc', 
						                     'label'   => 'Description', 
						                     'rules'   => 'TRIM|required|max_length[50]'
						                  ),
						     
										)
            		);
		return $config[$type];
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	

	private function _map(&$value){

		$value['checkbox']  = $this->_checkbox($value['id']);
		$value['buttons'] 	= $this->_access_inline($value['id']);

		return $value;
	}

	private function _checkbox($id=""){
		return '<input type="checkbox" class="doc" id="'.$id.'" />';
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->uri->segment(4)))),true);
	
	}

	private function _access_inline($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('id'		=> $id,
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->uri->segment(5)))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->uri->segment(4)))),true);

	}

	
}
