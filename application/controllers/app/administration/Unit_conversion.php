<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_conversion extends CI_Controller {
  
  private $module_id = 20;

  private $table 	 = "tblINV_UOMConversion";

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
		$data['title'] = "Administration: Unit Conversion";
		$this->load->vars($data);
		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-unit-conversion' => array(
						 										'buttons'				=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'				=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'UC_DocNo'				=> array('label' => 'Document No.'),
															 	'UC_DocDate'			=> array('label' => 'Document Date'),
															 	'base'					=> array('label' => 'Converted Base'),
																'UC_BaseQty'			=> array('label' => 'Base Qty'),
																'conv'					=> array('label' => 'Converted Unit'),
																'UC_ConversionQty'		=> array('label' => 'Converted Qty'),
																'UC_Active'				=> array('label' => 'Active'),
																'UC_DocumentStatus'		=> array('label' => 'Status')
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/unit_conversion_model');

		$data = $this->unit_conversion_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->unit_conversion_model->record_count($this->$table));
		}

		echo json_encode($result);

	}
	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Unit Conversion: Add";
		$this->load->vars($data);

		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('33');

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update(){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Unit Conversion: Edit";
		$this->load->vars($data);

		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('33');

		$this->load->model('app/administration/unit_conversion_model');
		$content['data'] 		=  $this->unit_conversion_model->get_spec_data_row($this->$table,array('md5("UC_DocNo")' 	=>  $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');

		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/unit-conversion/update',$content,true)));	
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

		$this->load->model('app/administration/unit_conversion_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['UC_Active'] = '1';
					
					$this->unit_conversion_model->add_data($this->$table,$this->input->post(NULL,TRUE));

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
					unset($_POST['uniqid'],$_POST['UC_DocNo']);
					
					$this->unit_conversion_model->update_data($this->$table,array('md5("UC_DocNo")' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->unit_conversion_model->update_data($this->$table,array('md5("UC_DocNo")' => $value),update_data(array('UC_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->unit_conversion_model->update_data($this->$table,array('md5("UC_DocNo")' => $value),update_data(array('UC_Active' => '0')));

				}
			break;
			case 'approve':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->unit_conversion_model->update_data($this->$table,array('md5("UC_DocNo")' => $value),update_data(array("UC_DocumentStatus" => '1')));

				}
			break;
			case 'cancel':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->unit_conversion_model->update_data($this->$table,array('md5("UC_DocNo")' => $value),update_data(array("UC_DocumentStatus" => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->unit_conversion_model->delete($this->$table,array('md5("UC_DocNo")' => $this->input->post('id')));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'UC_DocDate', 
			                     'label'   => 'Document No.', 
			                     'rules'   => 'TRIM|required|is_unique[tblINV_UOMConversion.UC_DocDate]'
			                  ),
			                array(
			                     'field'   => 'UC_DocDate', 
			                     'label'   => 'Document Date', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'UC_FK_BaseUOM_id', 
			                     'label'   => 'Base Unit', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'UC_BaseQty', 
			                     'label'   => 'Base Currency Qty', 
			                     'rules'   => 'TRIM|required|decimal'
			                  ),
			                array(
			                     'field'   => 'UC_FK_ConvUOM_id', 
			                     'label'   => 'Converted Unit', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'UC_ConversionQty', 
			                     'label'   => 'Converted Qty', 
			                     'rules'   => 'TRIM|required|decimal'
			                  ),
			            ),
			'update'	=> array(
				                array(
				                     'field'   => 'UC_DocDate', 
				                     'label'   => 'Document Date', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'UC_FK_BaseUOM_id', 
				                     'label'   => 'Base Unit', 
				                     'rules'   => 'TRIM|required|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'UC_BaseQty', 
				                     'label'   => 'Base Currency Qty', 
				                     'rules'   => 'TRIM|required|decimal'
				                  ),
				                array(
				                     'field'   => 'UC_FK_ConvUOM_id', 
				                     'label'   => 'Converted Unit', 
				                     'rules'   => 'TRIM|required|max_length[30]'
				                  ),
				                array(
				                     'field'   => 'UC_ConversionQty', 
				                     'label'   => 'Converted Qty', 
				                     'rules'   => 'TRIM|required|decimal'
				                  ),
				               )
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
