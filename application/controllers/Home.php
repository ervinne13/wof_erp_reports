<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
      	$title['title'] = "Home";
      	$this->module  	= $this->uri->segment(1);
      	$this->header 	= $this->load->view("templates/header",$title,true);
      	$this->footer 	= $this->load->view("templates/footer","",true);
      	$this->head 	= $this->load->view("templates/head-nav","",true);
    }
	public function index()
	{		

		$data = array(	  'header'	=> $this->header,
      					       'footer'	=> $this->footer,
      					       'head'	   => $this->head,
      					 );
		$this->load->view("home", $data);
	}
}

