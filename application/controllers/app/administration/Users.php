<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  private $module_id = 13;

  private $table 	 = "tblCOM_User";

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
		$data['title'] = "Administration: Users";
		$this->load->vars($data);
		
		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-users' => array(
						 										'buttons'			=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'U_User_id'			=> array('label' => 'Username'),
																'U_Username'		=> array('label' => 'Full Name'),
																'Position'			=> array('label' => 'Position'),
																'U_Status'			=> array('label' => 'Status'),
																)
						 					)
						);
				
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);

	}

	public function data(){
		
		$this->load->model('app/administration/user_model');

		$data = $this->user_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->user_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Users: Add";
		$this->load->vars($data);

		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();

		$this->load->model('app/administration/store_profile_model');
		$content['store'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'));

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Users: Edit";
		$this->load->vars($data);
		
		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();

		$this->load->model('app/administration/store_profile_model');
		$content['store'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'));

		$this->load->model('app/administration/user_model');
		$content['data'] 		=  $this->user_model->get_spec_data_row(array('md5("U_User_id")' 	=> $this->input->get('id')));
		$content['data']['id']	=  $this->input->get('id');
		
		$this->load->model('app/administration/company_access_model');
		$content['data']['location']	=  $this->company_access_model->get_spec_location_array(array('md5("CA_FK_User_id")' 	=> $this->input->get('id')));
		$content['data']['default']	=  $this->company_access_model->get_default_location(array('md5("CA_FK_User_id")' 	=> $this->input->get('id')));
		
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/users/update',$content,true)));	
			$this->load->view("templates/container", $page);
		}else{
			redirect(site_url()."app/error");
		}
	}

	public function profile(){
		
		$this->load->model('app/administration/user_model');
		$content['data']  	  =  $this->user_model->get_spec_data_profile($this->session->userdata('U_User_id'));
		
		$this->load->model('app/administration/company_access_model');
		$content['location']  =  $this->company_access_model->get_spec_location_array(array('CA_FK_User_id' => $this->session->userdata('U_User_id')));

		$this->load->view('app/administration/users/profile',$content);

	}

	public function back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($pk, $this->table);

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3));
	}
	
	public function settings(){

		if(!check_access($this->module_id,'Settings')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Users: Setting";
      	$this->load->vars($data);

		$query = array('table'		=> 'tblCOM_Module',
					   'fields'		=> array('m_moduleid','m_description',"COALESCE(".'"functions"'.",'') as functions","COALESCE(".'"access"'.",'') as access"),
					    'join'		=> array(array('tbljoin'	=> "(SELECT string_agg(concat_ws('+++',f_functionname,f_functionid),'||||') as functions ,f_m_moduleid FROM ".'"tblCOM_Function"'." GROUP BY f_m_moduleid) as a",
						   						   'onjoin'		=> 'a.f_m_moduleid = tblCOM_Module.m_moduleid'),
						    				 array('tbljoin'	=> "(SELECT string_agg(concat_ws('+++',ua_accessname,ua_accessid),'||||') as access ,ua_m_moduleid FROM ".'"tblCOM_UserAccess"'." GROUP BY ua_m_moduleid) as b",
						   						   'onjoin'		=> 'b.ua_m_moduleid = tblCOM_Module.m_moduleid')),
					   	'groupby'	=> 'm_moduleid,a.functions,b.access'
						);
      	
      	$this->load->model('app/administration/user_access_model');
      
		$aret = $this->user_access_model->get_spec_no_view((string) $this->input->get('id'));

					// array('table'	=> 'tblCOM_UserAccess',
					//      'fields'	=> 'up_ua_accessid',
					//      'join'		=> array(array('tbljoin' => 'tblCOM_UserProfile',
					//      						   'onjoin'  => 'tblCOM_UserProfile.up_ua_accessid = tblCOM_UserAccess.ua_accessid')),
					//      'where'	=> array('md5(up_p_positionid::text)' => (string) $this->input->get('id'),
					//      					 'ua_accessname !='	=> 'View')
					//     );
		
		$view =  $this->user_access_model->get_spec_with_view((string) $this->input->get('id'));  

					// array('table'	=> 'tblCOM_UserAccess',
					//      'fields'	=> 'up_ua_accessid',
					//      'join'		=> array(array('tbljoin' => 'tblCOM_UserProfile',
					//      						   'onjoin'  => 'tblCOM_UserProfile.up_ua_accessid = tblCOM_UserAccess.ua_accessid')),
					//      'where'	=> array('md5(up_p_positionid::text)' => (string) $this->input->get('id'),
					//      					 'ua_accessname'	=> 'View')
					// 	);
		$this->load->model('app/administration/user_function_model');
		
		$fret  = $this->user_function_model->get_spec_data(array('md5("UF_FK_User_id"::text)' => (string) $this->input->get('id')));  

						// array('table'	=> 'tblCOM_UserFunction',
					 //      'fields'	=> 'u_uf_functionid',
					 //      'where'	=> array('md5(uf_p_positionid::text)' => (string) $this->input->get('id'))
						// );
		
		$data['fret'] 	  = $fret ? array_column($fret, 'UF_FK_Function_id') : array();
		$data['aret']	  = $aret ? array_column($aret, 'UP_FK_Access_id') : array();	
		$data['view']	  = $view ? array_column($view, 'UP_FK_Access_id') : array();	

		$data['data']	  = $this->modules->sub_menu_tree($this->modules->get_all_modules(),$data);

      	$this->load->model('app/administration/user_model');
		$data['id']	       = $this->user_model->get_spec_data_row(array('md5("U_User_id"::text)' => (string) $this->input->get('id')));
		$data['function']  = $this->_functions_inside(array('data-id' => $data['id']['U_User_id']));
		if(!empty($data['id'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/users/settings',$data,true)));	
			$this->load->view("templates/container", $page);
	
		}else{
			redirect(site_url()."app/error");
		}
		
	}

	public function process(){

		$this->load->model('app/administration/user_model');
		switch ($this->input->post('type')) {
			case 'add':

			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['U_Status'] = '1';
					unset($_POST['rep_password']);
					$_POST['U_Password'] = md5($_POST['U_Password'].'123!@#');
						$this->user_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			$id = $this->input->post('uniqid');
			
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('update',$id))){
					unset($_POST['rep_password'],$_POST['uniqid']);
						
						$this->load->model('app/administration/company_access_model');
						$location = $this->company_access_model->get_spec_location_array(array('md5("CA_FK_User_id")' 	=> $id));

						$data['add'] 	= array_diff($this->input->post('U_FK_Location_id'),array_column($location,'CA_FK_Location_id'));
						$data['delete'] = array_diff(array_column($location,'CA_FK_Location_id'),$this->input->post('U_FK_Location_id'));
						unset($_POST['U_FK_Location_id']);
						$data['user'] 	= $this->input->post(NULL,TRUE);

						$this->user_model->update_main_data(array('md5("U_User_id")' => $id),$data);
						$this->load->model('app/administration/user_record_lock_model');
						$this->user_record_lock_model->record_unlock($id, $this->table);

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'change-pass':
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('change-pass',$id))){
					unset($_POST['rep_password'],$_POST['uniqid']);
					$_POST['U_Password'] =  md5($_POST['U_Password'].'123!@#');

						$this->user_model->update_data(array('md5("U_User_id")' => $id),update_data($this->input->post()));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update-pass':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('update-pass',$this->session->userdata('U_User_id')))){
					unset($_POST['rep_password'],$_POST['old_password']);
					$_POST['U_Password'] =  md5($_POST['U_Password'].'123!@#');

						$this->user_model->update_data(array('U_User_id' => $this->session->userdata('U_User_id')),update_data($this->input->post()));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'settings':
				
				$this->load->model('app/administration/user_profile_model');
			 	$this->load->model('app/administration/user_function_model');
			 
			
				$this->user_profile_model->delete_spec(array('UP_FK_User_id' => $this->input->post('id')));
				
				$this->user_function_model->delete_spec(array('UF_FK_User_id' => $this->input->post('id')));

				$data = json_decode($this->input->post('data'));
				
				foreach ($data as $key => $value) {
					
					if(!empty($value->name)){

						

						if(!empty($value->value[0])){

							foreach (json_decode($value->value[1]) as $acc => $access) {
									$this->user_profile_model->add_data(array('UP_FK_User_id' 		=> $value->name,
														 					  'UP_FK_Access_id' 	=> (int)$access,
														 					  'UP_FK_Module_id'   	=> $value->value[0]));
							}
						}
						if(!empty($value->value[0])){
							foreach (json_decode($value->value[2]) as $func => $function) {
								
								   $this->user_function_model->add_data(array('UF_FK_User_id' 		=> $value->name,
														 					  'UF_FK_Function_id' 	=> (int)$function,
														 					  'UF_FK_Module_id'		=> $value->value[0]
														 					));
							}
						}
					
					}else{
						redirect(site_url()."app/error");
					}
				}
			break;
			case 'activate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {

					$this->user_model->update_data(array('md5("U_User_id")' => $value),update_data(array('U_Status' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {

					$this->user_model->update_data(array('md5("U_User_id"::text)' => $value),update_data(array('U_Status' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->user_model->delete(array('md5("U_User_id"::text)' => $this->input->post('id')));

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
			                     'field'   => 'U_User_id', 
			                     'label'   => 'User ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_User.U_User_id]|min_length[6]'
			                  ),
			                array(
			                     'field'   => 'U_Username', 
			                     'label'   => 'Username', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),
			                array(
			                     'field'   => 'U_Password', 
			                     'label'   => 'Password', 
			                     'rules'   => 'TRIM|required|min_length[6]'
			                  ),
			                array(
			                     'field'   => 'rep_password', 
			                     'label'   => 'Password Confirmation', 
			                     'rules'   => 'TRIM|required|matches[U_Password]'
			                  ), 
			                array(
			                     'field'   => 'U_FK_Position_id', 
			                     'label'   => 'Position', 
			                     'rules'   => 'TRIM|required'
			                  ),
			                array(
			                     'field'   => 'U_FK_Location_id[]', 
			                     'label'   => 'Location', 
			                     'rules'   => 'required'
			                  ) 
                		),
			'update'	=> array(
								array(
				                     'field'   => 'U_User_id', 
				                     'label'   => 'User ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_User.U_User_id.md5("U_User_id").'.$uniqid.']|min_length[6]'
				                 ),
				                array(
				                     'field'   => 'U_Username', 
				                     'label'   => 'Username', 
				                     'rules'   => 'TRIM|required|max_length[100]'
			                     ),
				                array(
				                     'field'   => 'U_FK_Position_id', 
				                     'label'   => 'Position', 
				                     'rules'   => 'TRIM|required'
				                  ),
				                array(
				                     'field'   => 'U_FK_Location_id[]', 
				                     'label'   => 'Location', 
				                     'rules'   => 'required'
			                  	 )    
								),
				'change-pass' => array(
		                		array(
				                     'field'   => 'U_Password', 
				                     'label'   => 'Password', 
				                     'rules'   => 'TRIM|required|min_length[6]'
				                  ),
				                array(
				                     'field'   => 'rep_password', 
				                     'label'   => 'Password Confirmation', 
				                     'rules'   => 'TRIM|required|matches[U_Password]'
				                  ) 
		        				),
				'update-pass' => array(
								array(
				                     'field'   => 'old_password', 
				                     'label'   => 'Old Password', 
				                     'rules'   => 'TRIM|required|callback_check_old_password'
				                  ),
		                		array(
				                     'field'   => 'U_Password', 
				                     'label'   => 'Password', 
				                     'rules'   => 'TRIM|required|min_length[6]'
				                  ),
				                array(
				                     'field'   => 'rep_password', 
				                     'label'   => 'Password Confirmation', 
				                     'rules'   => 'TRIM|required|matches[U_Password]'
				                  ) 
		        				)
            );
		return $config[$type];
	}

	public function check_old_password($str){
		$this->load->model('app/administration/user_model');
		if($this->user_model->get_spec_data(array('U_Password' => md5($str.'123!@#')))){
			return TRUE;
		}else{
			$this->form_validation->set_message('check_old_password',"Old Password doesn't match!");
			return FALSE;
		}
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	


	private function _functions(){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'=> $this->module_id))),true);
	
	}

	private function _functions_inside($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_inside(array('UF_FK_Module_id'=> $this->module_id))),true);
	
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
