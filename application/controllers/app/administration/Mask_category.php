<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mask_category extends CI_Controller {

  private $module_id = 173;

  private $table 	 = "tblINV_MaskCat";

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
		$data['title'] = "Administration: Mask Category";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-mask-category' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'MC_Level'		=> array('label' => 'Level'),
																'MC_Desc'		=> array('label' => 'Desciption'),
																'MC_Width'		=> array('label' => 'Width'),
																'MC_LabelUse'	=> array('label' => 'Label Use'),
																'MC_Active'		=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/mask_category_model');

		$data = $this->mask_category_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->mask_category_model->record_count());
		}
		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Mask Category: Add";
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

		$data['title'] = "Administration: Mask Category: Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/mask_category_model');

		$content['data']	 = $this->mask_category_model->get_spec_data(array('md5("MC_Level"::text)' => (string) $this->input->get('id')));
		
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/mask-category/update',$content,true)));	
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

		$this->load->model('app/administration/mask_category_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){

						$this->mask_category_model->add_data($this->input->post(NULL,TRUE));

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

						$this->mask_category_model->update_data(array('md5("MC_Level"::text)' => $id),update_data($this->input->post(NULL,TRUE)));
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

					$this->mask_category_model->update_data(array('md5("MC_Level"::text)' => $value),update_data(array('MC_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {

					$this->mask_category_model->update_data(array('md5("MC_Level"::text)' => $value),update_data(array('MC_Active' => '0')));
				}
			break;
			case 'delete':
				
				echo  $this->mask_category_model->delete(array('md5("MC_Level"::text)' => $this->input->post('id')));

			break;
		}
	}


	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'MC_Level', 
			                     'label'   => 'Level', 
			                     'rules'   => 'TRIM|required|is_unique[tblINV_MaskCat.MC_Level]'
			                  ),
			                array(
			                     'field'   => 'MC_Desc', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'MC_Width', 
			                     'label'   => 'Width', 
			                     'rules'   => 'TRIM|required|integer'
			                  )

                		),
			'update'	=> array(
								array(
				                     'field'   => 'MC_Level', 
				                     'label'   => 'Level', 
				                     'rules'   => 'TRIM|required|is_unique2[tblINV_MaskCat.MC_Level.md5("MC_Level"::text).'.$uniqid.']'
				                 ),
								array(
			                     'field'   => 'MC_Desc', 
			                     'label'   => 'Description', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  	),
				                array(
			                     'field'   => 'MC_Width', 
			                     'label'   => 'Width', 
			                     'rules'   => 'TRIM|required|integer'
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
		
		$value['checkbox']  = $this->_checkbox(md5($value['MC_Level']));
		$value['buttons'] 	= $this->_access_inline(md5($value['MC_Level']));

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Position_id'=> $this->session->userdata('U_FK_Position_id'),
															 																			 		 'UF_FK_Module_id'	=> $this->module_id))),true);
	
	}

	private function _access_inline($id=""){

		$this->load->model('app/administration/user_profile_model');
		return  $this->load->view("templates/access_inline",array('id'		=> $id,
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Position_id'=> $this->session->userdata('U_FK_Position_id'),
																  																				 		 'UP_FK_Module_id'	=> $this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Position_id'	=> $this->session->userdata('U_FK_Position_id'),
																																						'UP_FK_Module_id'	=> $this->module_id))),true);

	}
	
}
