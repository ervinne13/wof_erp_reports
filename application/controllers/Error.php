<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

  public function __construct()
    {
        parent::__construct();
      	$title['title'] = "Error 404";
      	$this->module 	= $this->uri->segment(1);
      	$this->header 	= $this->load->view("templates/header",$title,true);
      	$this->footer 	= $this->load->view("templates/footer","",true);
      	$this->navs 	= $this->load->view("templates/side-nav","",true);
      	$this->head 	= $this->load->view("templates/head-nav","",true);
    }
	public function index()
	{		
		$this->output->set_status_header('404');
		$data = array(	  'header'	=> $this->header,
  					       'footer'	=> $this->footer,
  					       'head'	   => $this->head,
      					 );
		$this->load->view("error", $data);
	}
}

