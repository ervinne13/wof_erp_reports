<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Position extends CI_Controller {

  public function __construct()
    {
        parent::__construct();

      	if(!is_logged_in()['status']){
          redirect(base_url(), 'refresh');
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
		$data['title'] = "Administration: Position";
		$this->load->vars($data);

		$content = array('function'=> $this->load->view(uri_string()."/function","",true),
						 'table'  => array('tbl-position' => array(
						 										'buttons'			=> array('label' => '<a href="'.base_url().uri_string()."/add".'" data-container="body" data-toggle="tooltip" data-placement="top" title="New"><span class="glyphicon glyphicon-plus"></span></a>','sorts' => true),
															 	'P_Position_id'		=> array('label' => 'Position ID'),
																'P_Position'		=> array('label' => 'Position'),
															 	'P_Type'			=> array('label' => 'Header'),
																'P_ApproverCode'	=> array('label' => 'Approver'),
																'P_Amount'			=> array('label' => 'Amount'),
																'P_Unlimited'		=> array('label' => 'Unlimited'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function data(){
		
		$this->load->model('app/administration/position_model');

		$data = $this->position_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $this->position_model->record_count());
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->position_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){
		$data['title'] = "Administration: Position: Add";
      	$this->load->vars($data);
		
		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){
		$data['title'] = "Administration: Position: Edit";
      	$this->load->vars($data);
		
		$this->load->model('app/administration/position_model');
		$content['position'] = $this->position_model->get_all_data();
		
		$content['data'] =  $this->position_model->get_spec_data(array('md5("P_Position_id"::text)' 	=> (string) $this->input->get('id')));
		
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/position/update',$content,true)));	
			$this->load->view("templates/container", $page);
		}else{
			redirect(base_url()."app/error", 'refresh');
		}
	}

	public function settings(){
		$data['title'] = "Administration: Position: Setting";
      	$this->load->vars($data);

		// $query = array('table'		=> 'tblCOM_Module',
		// 			   'fields'		=> array('m_moduleid','m_description',"COALESCE(".'"functions"'.",'') as functions","COALESCE(".'"access"'.",'') as access"),
		// 			    'join'		=> array(array('tbljoin'	=> "(SELECT string_agg(concat_ws('+++',f_functionname,f_functionid),'||||') as functions ,f_m_moduleid FROM ".'"tblCOM_Function"'." GROUP BY f_m_moduleid) as a",
		// 				   						   'onjoin'		=> 'a.f_m_moduleid = tblCOM_Module.m_moduleid'),
		// 				    				 array('tbljoin'	=> "(SELECT string_agg(concat_ws('+++',ua_accessname,ua_accessid),'||||') as access ,ua_m_moduleid FROM ".'"tblCOM_UserAccess"'." GROUP BY ua_m_moduleid) as b",
		// 				   						   'onjoin'		=> 'b.ua_m_moduleid = tblCOM_Module.m_moduleid')),
		// 			   	'groupby'	=> 'm_moduleid,a.functions,b.access'
		// 				);
      	
      	$this->load->model('app/administration/User_access_model');
      
		$aret = $this->User_access_model->get_spec_no_view((string) $this->input->get('id'));

					// array('table'	=> 'tblCOM_UserAccess',
					//      'fields'	=> 'up_ua_accessid',
					//      'join'		=> array(array('tbljoin' => 'tblCOM_UserProfile',
					//      						   'onjoin'  => 'tblCOM_UserProfile.up_ua_accessid = tblCOM_UserAccess.ua_accessid')),
					//      'where'	=> array('md5(up_p_positionid::text)' => (string) $this->input->get('id'),
					//      					 'ua_accessname !='	=> 'View')
					//     );
		
		$view =  $this->User_access_model->get_spec_with_view((string) $this->input->get('id'));  

					// array('table'	=> 'tblCOM_UserAccess',
					//      'fields'	=> 'up_ua_accessid',
					//      'join'		=> array(array('tbljoin' => 'tblCOM_UserProfile',
					//      						   'onjoin'  => 'tblCOM_UserProfile.up_ua_accessid = tblCOM_UserAccess.ua_accessid')),
					//      'where'	=> array('md5(up_p_positionid::text)' => (string) $this->input->get('id'),
					//      					 'ua_accessname'	=> 'View')
					// 	);

		$this->load->model('app/administration/user_function_model');
		$fret  = $this->user_function_model->get_spec_data(array('md5("UF_FK_Position_id"::text)' => (string) $this->input->get('id')));  

						// array('table'	=> 'tblCOM_UserFunction',
					 //      'fields'	=> 'u_uf_functionid',
					 //      'where'	=> array('md5(uf_p_positionid::text)' => (string) $this->input->get('id'))
						// );
	
		$data['fret'] 	  = isset($fret['data']) ? array_column($fret['data'], 'U_FK_Function_id') : array();
		$data['aret']	  = isset($aret['data']) ? array_column($aret['data'], 'UP_FK_Access_id') : array();	
		$data['view']	  = isset($view['data']) ? array_column($view['data'], 'UP_FK_Access_id') : array();	
      	$data['data']	  = $this->modules->sub_menu_tree($this->modules->get_all_modules(),$data);

      	$this->load->model('app/administration/position_model');
		$data['id']	       = $this->position_model->get_spec_data(array('md5("P_Position_id"::text)' => (string) $this->input->get('id')));
		
		if(!empty($data['id'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/position/settings',$data,true)));	
			$this->load->view("templates/container", $page);
	
		}else{
			redirect(base_url()."app/error", 'refresh');
		}
		
	}

	public function process(){
		
		$this->load->model('app/administration/position_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					unset($_POST['rep_password']);
					$_POST['P_ApproverCode'] = $_POST['P_ApproverCode'] == '' ? 0:$_POST['P_ApproverCode']; 
					
					$this->position_model->add_data($this->input->post());

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
					$_POST['P_ApproverCode'] = $_POST['P_ApproverCode'] == '' ? 0:$_POST['P_ApproverCode'];

					$this->position_model->update_data(array('md5("P_Position_id"::text)' => $id),update_data($this->input->post()));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'settings':
				$this->queries->delete(array('table'	=> 'tblCOM_UserProfile',
											 'uniqid'	=> 'up_p_positionid',
											 'dataid'	=>  $this->input->post('id')
											));

			 	$this->queries->delete(array('table'	=> 'tblCOM_UserFunction',
											 'uniqid'	=> 'uf_p_positionid',
											 'dataid'	=>  $this->input->post('id')
											));

				foreach ($this->input->post('data') as $key => $value) {
					
					if(!empty($value['name'])){

						

						if(!empty($value['value'][0])){

							foreach (json_decode($value['value'][1]) as $acc => $access) {
								   $this->queries->insert(array('table' 	=> 'tblCOM_UserProfile',
																 'data'	 	=> add_data(array('up_p_positionid' => $value['name'],
																		 					  'up_ua_accessid' 	=> $access,
																		 					  'up_m_moduleid'   => $value['value'][0]
																		 					))
																	));
							}
						}
						if(!empty($value['value'][0])){
							foreach (json_decode($value['value'][2]) as $func => $function) {
								   $this->queries->insert(array('table' 	=> 'tblCOM_UserFunction',
																 'data'	 	=> add_data(array('uf_p_positionid' 	=> $value['name'],
																		 					  'u_uf_functionid' 	=> $function,
																		 					  'uf_m_moduleid'		=> $value['value'][0]
																		 					))
																	));
							}
						}
					
					}else{
						redirect(base_url()."app/error", 'refresh');
					}
				}
			break;
		}
	}


	private function _map(&$value){
		// $value['checkbox']  = $this->_checkbox($value['u_userid']);
		$value['buttons'] 	= $this->_functions_inline($value['P_Position_id']);

		return $value;
	}

	private function _functions_inline($id=""){
		return '<a href="'.base_url('app/administration/position/update?id='.md5($id)).'" data-container="body" data-toggle="tooltip" data-placement="top" title="Update">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
				<a href="'.base_url('app/administration/position/settings?id='.md5($id)).'" data-container="body" data-toggle="tooltip" data-placement="top" title="Settings">
					<span class="glyphicon glyphicon-cog"></span>
				</a>
				';

	}


	private function _checkbox($id=""){
		return '<input type="checkbox" class="u_userid" id="'.md5($id).'" />';
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'P_Position_id', 
			                     'label'   => 'Position ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_Position.P_Position_id]'
			                  ),
			                array(
			                     'field'   => 'P_Position', 
			                     'label'   => 'Position', 
			                     'rules'   => 'TRIM|required|is_unique[tblCOM_Position.P_Position]'
			                  )
			            ),
			'update'	=> array(
								array(
				                     'field'   => 'P_Position_id', 
				                     'label'   => 'Position ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_Position.P_Position_id.md5("P_Position_id"::text).'.$uniqid.']'
				                  ),
				                array(
				                     'field'   => 'P_Position', 
				                     'label'   => 'Position', 
				                     'rules'   => 'TRIM|required|is_unique2[tblCOM_Position.P_Position.md5("P_Position_id"::text).'.$uniqid.']'
			                  		),
				               )
            );
		return $config[$type];
	}
	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	


	// private function _functions_general(){

	// }

	// private function _navigation(){

	// }
	
}
