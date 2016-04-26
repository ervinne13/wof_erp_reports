<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules extends CI_Controller {

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
		$data['title'] = "Administration: Modules";
		$this->load->vars($data);

		$content = array('table'  => array('tbl-modules' => array(
															 	'M_Module_id'		=> array('label' => 'Module ID'),
																'M_Description'		=> array('label' => 'Description'),
																'functions'			=> array('label' => 'Functions'),
																'access'			=> array('label' => 'Access'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){

		$this->load->model('app/administration/module_model');

		$data = $this->module_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$result = array('records' 			=> $data['data'],
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->module_model->record_count());
		}

		echo json_encode($result);

	}

}
