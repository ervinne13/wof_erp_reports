<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_setup extends CI_Controller {

  public function __construct()
    {
        parent::__construct();
      	$data['title'] = "Admin: Module Setup";
      	$this->load->vars($data);
      	$this->data 	= array('header'	=> $this->load->view("templates/header","",true),
							  	'footer'	=> $this->load->view("templates/footer","",true),
							  	'navs'		=> $this->load->view('admin/module',"",true),
							  	'head'		=> $this->load->view("admin/head-nav","",true),
							  );
      	if(!is_logged_in()['status']){
          redirect(base_url(), 'refresh');
        }
    }
	public function index()
	{		
		$content = array('function'=> $this->load->view(uri_string()."/function","",true),
						 'table'  => array('tbl-module-setup' => array(
						 										'buttons'				=> array('label' => '<a href="'.base_url('admin/module-setup/add').'" data-container="body" data-toggle="tooltip" data-placement="top" title="New"><span class="glyphicon glyphicon-plus"></span></a>','sorts' => true),
															 	'checkbox'				=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'm_moduleid'			=> array('label' => 'Module ID'),
															 	'm_description'			=> array('label' => 'Module'),
															 	'm_level'				=> array('label' => 'Parent Module'),
															 	'm_trigger'				=> array('label' => 'Target Function'),
															 	'm_icon'				=> array('label' => 'Icon'),
															 	'm_grouping'			=> array('label' => 'Level'),
																'm_active'				=> array('label' => 'Active'),
																)
						 					)
						);
	
		$this->data['content'] = $this->load->view('admin/module-setup/index',$content,true);
				

		$this->load->view("templates/container", $this->data);

	}

	public function data(){
		
		extract($this->input->get());
		
		$query = array('table'	=> 'tblCOM_Module',
					   'fields'	=> array('m_moduleid',
					   					 'm_description',
					   					 'm_level',
					   					 'm_trigger',
					   					 'm_icon',
					   					 'm_grouping',
										 "(CASE WHEN m_active = '1' THEN 'Active' WHEN m_active = '0' THEN 'Inactive' END) as m_active",
										 ),
					  'limit'	=> $perPage,
					   'offset'	=> $offset,
					   'order'	=> 'tblCOM_Module.m_moduleid DESC',
					   'groupby'=> 'tblCOM_Module.m_moduleid'
						);
	
		if(isset($queries['search'])){
				$query['or_having']["LOWER(CAST(m_moduleid as text)) LIKE"] = '%'.strtolower($queries['search']).'%';
				$query['or_having']["LOWER(CAST(m_description as text)) LIKE"] = '%'.strtolower($queries['search']).'%';
				$query['or_having']["LOWER(CAST(m_level as text)) LIKE"] = '%'.strtolower($queries['search']).'%';
				$query['or_having']["LOWER(CAST(m_trigger as text)) LIKE"] = '%'.strtolower($queries['search']).'%';
				$query['or_having']["LOWER(CAST(m_icon as text)) LIKE"] = '%'.strtolower($queries['search']).'%';
				$query['or_having']["LOWER(CAST(m_grouping as text)) LIKE"] = '%'.strtolower($queries['search']).'%';
				$query['or_having']["LOWER((CASE WHEN m_active = '1' THEN 'Active' WHEN m_active = '0' THEN 'Inactive' END)) LIKE"] = '%'.strtolower($queries['search']).'%';
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$query['order'] = implode(",", $res);
		}

		$data = $this->queries->get_data($query);

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $this->queries->total_rows($query));
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> 0);
		}

		echo json_encode($result);

	}

	public function add(){

		$query = array('table'	=> 'tblCOM_Module',
					   'fields'	=> 'm_moduleid,m_description',
					   );
		$content['mod'] = $this->queries->get_data($query);

		
		$this->data['content'] = $this->load->view('admin/module-setup/add',$content,true);
		$this->load->view("templates/container", $this->data);
	}

	public function update(){
		$query = array('table'	=> 'tblCOM_Module',
					   'fields'	=> 'm_moduleid,m_description',
					   );
		$updata = array('table'	=> 'tblCOM_Module',
					   'fields'	=> array('m_moduleid'),
					   'fields'	=> array('m_description',
										 'm_moduleid',
										 'm_level',
										 'm_trigger',
										 'm_grouping',
										 'm_icon'),
					   'where'	=> array('m_moduleid' => (int) $this->input->get('id')),
					   'groupby'=> 'm_moduleid',
					   'row'	=> true
						);

		$content['mod']        = $this->queries->get_data($query);
		$content['data']	   = $this->queries->get_data($updata);
		$this->data['content'] = $this->load->view('admin/module-setup/update',$content,true);
		//echo $this->db->last_query();
		if(!empty($content['data'])){
			$this->load->view("templates/container", $this->data);
		}else{
			redirect(base_url()."app/error", 'refresh');
		}
	}

	public function process(){

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				if($this->_validate($this->_validation_config('add'))){
					$_POST['m_active'] = '1';
					$_POST['m_level'] = $_POST['m_level']?$_POST['m_level']:0;
					$data=$this->queries->insert(array(	'table' 	=> 'tblCOM_Module',
														'data'	 	=> $this->input->post()
											));
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
					$_POST['m_level'] = $_POST['m_level']?$_POST['m_level']:0;
					$data=$this->queries->update(array(	'table' 	=> 'tblCOM_Module',
														'data'	 	=> $this->input->post(),
														'tbluid'	=> 'm_moduleid',
														'dataid'	=> $id
											));
					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'activate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					$this->queries->update(array(	'table' 	=> 'tblCOM_Module',
													'data'	 	=> array('m_active' => '1'),
													'tbluid'	=> 'm_moduleid',
													'dataid'	=> $value
											));
				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					$this->queries->update(array(	'table' 	=> 'tblCOM_Module',
													'data'	 	=> array('m_active' => '0'),
													'tbluid'	=> 'm_moduleid',
													'dataid'	=> $value
											));
				}
			break;
		}
	}

	private function _map(&$value){
		$value['checkbox']  = $this->_checkbox($value['m_moduleid']);
		$value['buttons'] 	= $this->_functions_inline($value['m_moduleid']);

		return $value;
	}
	private function _functions_inline($id=""){
		return '<a href="'.base_url('admin/module-setup/update?id='.$id).'" data-container="body" data-toggle="tooltip" data-placement="top" title="Update">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
				';

	}

	private function _checkbox($id=""){
		return '<input type="checkbox" class="ss" id="'.$id.'" />';
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'm_description', 
			                     'label'   => 'Module', 
			                     'rules'   => 'TRIM|required'
			                  ),
			            ),
			'update'	=> array(
				                array(
			                     'field'   => 'm_description', 
			                     'label'   => 'Module', 
			                     'rules'   => 'TRIM|required'
			                  	),
				               )
            );
		return $config[$type];
	}
	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	
	
}
