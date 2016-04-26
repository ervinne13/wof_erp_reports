<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class No_series extends CI_Controller {

  private $module_id = 16;

  private $table 	 = "tblCOM_NoSeries";

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
		$data['title'] = "Administration: Document Number";
		$this->load->vars($data);	
		$content = array('table'  => array('tbl-no-series' => array(
						 										'buttons'			=> array('label' => $this->_access_header(),'sorts' => true),
															 	'NS_Id'				=> array('label' => 'No. Series ID'),
															 	'NS_Description'	=> array('label' => 'Description'),
																'M_Description'		=> array('label' => 'Module'),
																'NS_Location'		=> array('label' => 'Location'),
																'NS_StartNo'		=> array('label' => 'Starting No.'),
																'NS_EndingNo'		=> array('label' => 'Ending No.'),
																'NS_LastNoUsed'		=> array('label' => 'Last No. Used'),
																'NS_LastDateUsed'	=> array('label' => 'Last Date Used'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' =>  $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/no_series_model');

		$data = $this->no_series_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->no_series_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Document Number: Add";
		$this->load->vars($data);	

		$this->load->model('app/administration/module_model');
		$content['module'] = $this->module_model->get_all_data_dropdown();

		$this->load->model('app/administration/store_profile_model');
		$content['location'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'));

		$page = array_merge($this->_settings(),array('content' =>   $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update(){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Document Number: Edit";
		$this->load->vars($data);	
	
		$this->load->model('app/administration/module_model');
		$content['module'] = $this->module_model->get_all_data_dropdown();

		$this->load->model('app/administration/store_profile_model');
		$content['location'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'));

		$this->load->model('app/administration/no_series_model');
		$content['data'] 		=  $this->no_series_model->get_spec_data_row(array('md5("NS_Id")' => $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' =>  $this->load->view('app/administration/no-series/update',$content,true)));	
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

		$this->load->model('app/administration/no_series_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					
					$this->_set_default();
					$this->no_series_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			// print_r($_POST);
			$id = $this->input->post('uniqid');
			$this->_set_default();
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('update',$id))){
					unset($_POST['uniqid']);

					$this->no_series_model->update_data(array('md5("NS_Id"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
					$this->load->model('app/administration/user_record_lock_model');
					$this->user_record_lock_model->record_unlock($id, $this->table);
					
					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'delete':
				
				echo  $this->no_series_model->delete(array('md5("NS_Id"::text)' => $this->input->post('id')));

			break;

			case 'set-default':
				
				echo  $this->no_series_model->set_default($this->input->post(NULL,TRUE));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'NS_Id', 
			                     'label'   => 'No Series ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_NoSeries.NS_Id]|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'NS_Description', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_NoSeries.NS_Description]|max_length[200]'
			                  ),
			                array(
			                     'field'   => 'NS_Location', 
			                     'label'   => 'Location', 
			                     'rules'   => 'TRIM|required'
			                  	),
			                array(
			                     'field'   => 'NS_FK_Module_id', 
			                     'label'   => 'Module', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'NS_StartNo', 
			                     'label'   => 'Starting No.', 
			                     'rules'   => 'TRIM|required|integer|max_length[30]|less_than['.$_POST['NS_EndingNo'].']'
			                  ), 
			                array(
			                     'field'   => 'NS_EndingNo', 
			                     'label'   => 'Ending No.', 
			                     'rules'   => 'TRIM|required|integer|max_length[30]|greater_than['.$_POST['NS_StartNo'].']'
			                  ),

			            ),
			'update'	=> array(
								array(
				                     'field'   => 'NS_Id', 
				                     'label'   => 'No Series ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_NoSeries.NS_Id.md5("NS_Id").'.$uniqid.']'
				                 ),
				                array(
				                     'field'   => 'NS_Description', 
			                         'label'   => 'Description', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_NoSeries.NS_Description.md5("NS_Id").'.$uniqid.']|max_length[200]'
				                  ), 
				                array(
			                     'field'   => 'NS_Location', 
			                     'label'   => 'Location', 
			                     'rules'   => 'TRIM|required'
			                  	),
				                array(
				                     'field'   => 'NS_FK_Module_id', 
				                     'label'   => 'Module', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'NS_StartNo', 
				                     'label'   => 'Starting No.', 
				                     'rules'   => 'TRIM|required|integer|max_length[30]|less_than['.$_POST['NS_EndingNo'].']'
				                  ), 
				                array(
				                     'field'   => 'NS_EndingNo', 
				                     'label'   => 'Ending No.', 
				                     'rules'   => 'TRIM|required|integer|max_length[30]|greater_than['.$_POST['NS_StartNo'].']'
				                  ),
				                array(
				                     'field'   => 'NS_LastNoUsed', 
				                     'label'   => 'Last No. Used', 
				                     'rules'   => 'TRIM|integer|max_length[30]'
				                  ),
				               )
            );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					'NS_StartNo'		=> 'integer',
					'NS_EndingNo'		=> 'integer',

					);
		if(isset($_POST['NS_LastDateUsed'])){
			$config['NS_LastDateUsed'] = 'null';
		}

		if(isset($_POST['NS_LastDateUsed'])){
			$config['NS_LastNoUsed'] = 'integer';
		}

		$this->load->library('set_default');
		$this->set_default->set_config($config);
		$this->set_default->run();
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	
	
	private function _map(&$value){

		$value['buttons'] 	= $this->_access_inline($value['id']);
		// $value['default'] 	= $this->_default($value);

		return $value;
	}

	// private function _default($value){
	// 	$checked = $value['NS_Default']=='1'?'checked':'';
	// 	return '<input type="radio" class="default" '.$checked.'  name="'.$value['NS_FK_Module_id'].'" value="'.$value['NS_Id'].'" />';
	// }

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
