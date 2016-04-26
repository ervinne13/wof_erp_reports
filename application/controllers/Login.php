<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
    {
        parent::__construct();
      	$title['title'] = "Login";
      	$this->module  	= $this->uri->segment(1);
      	$this->header 	= $this->load->view("templates/header",$title,true);
      	$this->footer 	= $this->load->view("templates/footer","",true);
      	$this->head 	  = $this->load->view("templates/head-nav","",true);
        
    }
  public function index()
  {   

    if(is_logged_in()['status']){
      redirect(site_url()."app",'refresh');
    }
    
    $data = array('header'  => $this->header,
      					  'footer'	=> $this->footer,
      					  'head'	  => $this->head,
      					 );
		$this->load->view("login", $data);
	}
  public function verify(){
    $_POST['U_Password'] = md5($_POST['U_Password'].'123!@#');
   
    $this->load->model('app/administration/user_model');
    $result    =  $this->user_model->get_spec_data_row(array_merge($this->input->post(),array('U_Status' => '1')));
    
    if(!$result){
      $data = array('header'  => $this->header,
                    'footer'  => $this->footer,
                    'head'    => $this->head,
                    'error'   => 1
                 );
      $this->load->view('login',$data);
    }else{
      $this->session->set_userdata($result);
      
      $this->load->model('app/administration/company_access_model');
      
      $location =  $this->company_access_model->get_spec_location_array(array('CA_FK_User_id'  => $result['U_User_id']));
      $this->session->set_userdata('location',$location);
      $dLocation =  $this->company_access_model->get_default_location(array('CA_FK_User_id'  => $result['U_User_id'],'CA_DefaultLocation' => '1'));
      $this->session->set_userdata('dlocation',$dLocation);

      $access = array('grouping'                    => $this->modules->get_module_grouping(),
                      'all'                         => $this->modules->get_modules(),
                      'administration'              => $this->modules->get_sub_modules(1),
                      'financial-management'        => $this->modules->get_sub_modules(3),
                      'fixed-asset-management'      => $this->modules->get_sub_modules(5),
                      'human-resource-recruitment'  => $this->modules->get_sub_modules(7),
                      'purchasing'                  => $this->modules->get_sub_modules(2),
                      'repairs-maintenance'         => $this->modules->get_sub_modules(186),
                      'sales-operation'             => $this->modules->get_sub_modules(4),
                      'warehouse-management'        => $this->modules->get_sub_modules(6),
                      'reports'                     => $this->modules->get_sub_modules(8)
                      );

      $this->session->set_userdata($access);

      redirect(site_url()."app");
    }

  }
}
