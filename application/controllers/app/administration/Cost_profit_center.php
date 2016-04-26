<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cost_profit_center extends CI_Controller {
  private $module_id = 23;

  private $table 	 = "tblCOM_CPCenter";
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
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'CPC_Id');
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
		$data['title'] = "Administration: Cost Profit Center";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-cost-center-profit' => array(
								 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
																	 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
																	 	'CPC_Id'		=> array('label' => 'Cost Profit Center ID'),
																		'CPC_Desc'		=> array('label' => 'Description'),
																		'CPC_Active'	=> array('label' => 'Active'),
																		)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/cost_profit_center_model');

		$data = $this->cost_profit_center_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->cost_profit_center_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Cost Profit Center: Add";
      	$this->load->vars($data);

		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('152');

		
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Cost Profit Center: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('152');

		$this->load->model('app/administration/cost_profit_center_model');
		$content['data'] 		=  $this->cost_profit_center_model->get_spec_data_row(array('md5("CPC_Id")' 	=>  $this->input->get('id')));
		$content['data']['id']  =  $this->input->get('id');
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/cost-profit-center/update',$content,true)));	
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

		$this->load->model('app/administration/cost_profit_center_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['CPC_Active'] = '1';
					
					$this->_set_default();
					$this->cost_profit_center_model->add_data($this->input->post(NULL,TRUE));

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
					
					$this->_set_default();
					$this->cost_profit_center_model->update_data(array('md5("CPC_Id"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->cost_profit_center_model->update_data(array('md5("CPC_Id"::text)' => $value),update_data(array('CPC_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->cost_profit_center_model->update_data(array('md5("CPC_Id"::text)' => $value),update_data(array('CPC_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->cost_profit_center_model->delete(array('md5("CPC_Id"::text)' => $this->input->post('id')));

			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'CPC_Id','CPC_Active');
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
			                     'field'   => 'CPC_Id', 
			                     'label'   => 'Cost Profit Center ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_CPCenter.CPC_Id]'
			                  ),
			                array(
			                     'field'   => 'CPC_Desc', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'CPC_FK_Class', 
			                     'label'   => 'Class', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  )
                		),
			'update'	=> array(
								array(
				                     'field'   => 'CPC_Id', 
				                     'label'   => 'Cost Profit Center ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_CPCenter.CPC_Id.md5("CPC_Id").'.$uniqid.']'
				                 ),
				                array(
				                     'field'   => 'CPC_Desc', 
				                     'label'   => 'Description', 
				                     'rules'   => 'TRIM|required'
			                  	  ),

				                array(
			                     'field'   => 'CPC_FK_Class', 
			                     'label'   => 'Class', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  )
							),
            );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					'CPC_FK_Class'		=> 'null'
					);

		$this->load->library('set_default');
		$this->set_default->set_config($config);
		$this->set_default->run();
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

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=>$this->module_id))),true);

	}
	
}
