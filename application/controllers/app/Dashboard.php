<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct()
    {
        parent::__construct();

        if(!is_logged_in()['status']){
          redirect(base_url(), 'refresh');
        }

        $data['title'] = "Dashboard";
        $data['mod_group'] = $this->session->userdata('grouping');
        $this->load->vars($data);
        $this->data   = array('header'  => $this->load->view("templates/header","",true),
                              'footer'  => $this->load->view("templates/footer","",true),
                              'head'    => $this->load->view("templates/head-nav","",true),
                            );
    }

  public function index()
  {   
    // $this->load->library('PHPRequests');
    // $headers = array('accept' => 'application/json');
    // $option  = array();
    // $data =  array('id'    => 1,
                  // 'name'  => 'test');
    // echo "<pre>";
    // print_r(json_decode(Requests::get('http://127.0.0.1/codeigniter/api/example/users',$headers,$option)->body));

    $this->load->view("app/dashboard",$this->data);
           
  }
}

