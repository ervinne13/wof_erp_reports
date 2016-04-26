<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

  public function __construct()
    {
        parent::__construct();
    
    }
  public function index(){
  	
  	$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->delete();

    $this->session->sess_destroy();
    redirect(site_url());

  }
}
