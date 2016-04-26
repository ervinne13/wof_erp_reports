<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

  public function __construct()
    {
        parent::__construct();

        if(!is_logged_in()['status']){
          redirect(base_url(), 'refresh');
        }
        $data['title'] = "Reports";
        $data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');
        $this->load->vars($data);
        $this->data   = array('header'  => $this->load->view("templates/header","",true),
                              'footer'  => $this->load->view("templates/footer","",true),
                              'navs'    => $this->load->view('templates/side-nav',"",true),
                              'head'    => $this->load->view("templates/head-nav","",true),
                            );
    }

  public function index()
  {   
    $data['title'] = "Reports";

    $this->data['content']  = $this->load->view(uri_string().'/index',$data,true);
           
    $this->load->view("templates/container", $this->data);
  }

  
}
