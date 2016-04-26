<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exchange_rate extends CI_Controller {

  private $module_id = 19;

  private $table 	 = "tblACC_ExchangeRate";

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
      	$page 	= array('header'	=> $this->load->view("templates/header","",true),
					  	'footer'	=> $this->load->view("templates/footer","",true),
					  	'navs'		=> $this->load->view('templates/side-nav',"",true),
					  	'head'		=> $this->load->view("templates/head-nav","",true),
					  );
      	return $page;

    }
	public function index()
	{		
		$data['title'] = "Administration: Exchange Rate";
      	$this->load->vars($data);
      	
		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-exchange-rate' => array(
						 										'buttons'				=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'				=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'ER_DocumentNo'			=> array('label' => 'Document No.'),
															 	'ER_DocumentDate'	    => array('label' => 'Document Date'),
															 	'base'					=> array('label' => 'Base Currency'),
																'ER_BaseCurrencyRate'	=> array('label' => 'Base Currency Rate'),
																'conv'					=> array('label' => 'Converted Currency'),
																'ER_ConvCurrencyRate'	=> array('label' => 'Converted Currency Rate'),
																'ER_Active'				=> array('label' => 'Active'),
																'ER_DocumentStatus'		=> array('label' => 'Status')
																)
						 					)
						);
	
					
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	
		$this->load->view("templates/container", $page);

	}
    
    public function data(){
		
		$this->load->model('app/administration/exchange_rate_model');

		$data = $this->exchange_rate_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->exchange_rate_model->record_count());
		}

		echo json_encode($result);

	}


	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Exchange Rate: Add";
      	$this->load->vars($data);

		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('34');

		

		
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	
		$this->load->view("templates/container", $page);
	}

	public function update(){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Exchange Rate: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/attribute_model');
		$content['att'] = $this->attribute_model->get_spec_attribute_dropdown('34');


		$this->load->model('app/administration/exchange_rate_model');
		$content['data'] 		=  $this->exchange_rate_model->get_spec_data(array('md5("ER_DocumentNo")' 	=> $this->input->get('id')));
		$content['data']['id'] 	=  $this->input->get('id');

		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/exchange-rate/update',$content,true)));	
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

		$this->load->model('app/administration/exchange_rate_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['ER_Active'] = '1';
					
					$this->exchange_rate_model->add_data($this->input->post(NULL,TRUE));

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
					unset($_POST['uniqid'],$_POST['ER_DocumentNo']);
					
					$this->exchange_rate_model->update_data(array('md5("ER_DocumentNo")' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->exchange_rate_model->update_data(array('md5("ER_DocumentNo")' => $value),update_data(array('ER_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->exchange_rate_model->update_data(array('md5("ER_DocumentNo")' => $value),update_data(array('ER_Active' => '0')));

				}
			break;
			case 'approve':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->exchange_rate_model->update_data(array('md5("ER_DocumentNo")' => $value),update_data(array("ER_DocumentStatus" => '1')));

				}
			break;
			case 'cancel':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->exchange_rate_model->update_data(array('md5("ER_DocumentNo")' => $value),update_data(array("ER_DocumentStatus" => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->exchange_rate_model->delete(array('md5("ER_DocumentNo")' => $this->input->post('id')));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'ER_DocumentNo', 
			                     'label'   => 'Document No.', 
			                     'rules'   => 'TRIM|required|is_unique[tblACC_ExchangeRate.ER_DocumentNo]'
			                  ),
			                array(
			                     'field'   => 'ER_DocumentDate', 
			                     'label'   => 'Document Date', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'ER_FK_BaseCurrency_id', 
			                     'label'   => 'Base Currency', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'ER_BaseCurrencyRate', 
			                     'label'   => 'Base Currency Rate', 
			                     'rules'   => 'TRIM|required|numeric'
			                  ),
			                array(
			                     'field'   => 'ER_FK_ConvCurrency_id', 
			                     'label'   => 'Conveerted Currency', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'ER_ConvCurrencyRate', 
			                     'label'   => 'Converted Currency Rate', 
			                     'rules'   => 'TRIM|required|numeric'
			                  ),
			            ),
			'update'	=> array(
				                array(
				                     'field'   => 'ER_DocumentDate', 
				                     'label'   => 'Document Date', 
				                     'rules'   => 'TRIM|required'
			                  	  ),
				                array(
				                     'field'   => 'ER_FK_BaseCurrency_id', 
				                     'label'   => 'Base Currency', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'ER_BaseCurrencyRate', 
				                     'label'   => 'Base Currency Rate', 
				                     'rules'   => 'TRIM|required|numeric'
				                  ),
				                array(
				                     'field'   => 'ER_FK_ConvCurrency_id', 
				                     'label'   => 'Conveerted Currency', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'ER_ConvCurrencyRate', 
				                     'label'   => 'Converted Currency Rate', 
				                     'rules'   => 'TRIM|required|numeric'
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
		$value['ER_BaseCurrencyRate'] = numeric($value['ER_BaseCurrencyRate']);
		$value['ER_ConvCurrencyRate'] = numeric($value['ER_ConvCurrencyRate']);
		$value['ER_DocumentDate'] = format($value['ER_DocumentDate']);

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
