<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!is_logged_in()['status']){
            redirect(base_url(), 'refresh');
        }

        $data['title'] = "Returns";
        $data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');
        $this->load->vars($data);
        $this->data 	= array('header'	=> $this->load->view("templates/header","",true),
            'footer'	=> $this->load->view("templates/footer","",true),
            'navs'		=> $this->load->view('templates/side-nav',"",true),
            'head'		=> $this->load->view("templates/head-nav","",true),
        );

//        echo var_dump($data);exit;
    }

    public function index()
    {
        $this->data['content']	= $this->load->view(uri_string()."/index","",true);
        $this->load->view("templates/container", $this->data);
    }

    public function data(){
        $this->load->model('app/administration/user_model');
        $data = $this->user_model->table_data($this->input->get());

        if(!empty($data['rows'])){

            $dataresult  = array(
                'document_no' => 'CSR-10001',
                'document_date' => '03/11/16',
                'booth_area' => 'B1',
                'shift' => 'Opening',
                'issued_to' => '[Cashier]',
                'holiday' => 'Holiday',
                'status' => 'Open'
            );

            $result = array('records' 			=> $dataresult,
                'queryRecordCount'	=> $data['rows'],
                'totalRecordCount'	=> $data['count']);
        }else{

            $result = array('records' 			=> [],
                'queryRecordCount'	=> 0);
        }

        echo json_encode($result);

    }

    public function add(){
        $data['title'] = "Warehouse Management: Returns: Header Add";
        $this->load->vars($data);
        $this->data['content']	= $this->load->view(uri_string(),"",true);

        $this->load->view("templates/container", $this->data);
    }

    public function edit(){
        $data['title'] = "Warehouse     Management: Returns: Header Edit";
        $this->load->vars($data);
        $this->data['content']	= $this->load->view(uri_string(),"",true);

        $this->load->view("templates/container", $this->data);
    }
    public function view($params=null){
        switch ($params) {
            case null:
                $data['title'] = "Warehouse Management: Returns: View";
                $this->load->vars($data);
                $this->data['content'] = $this->load->view(uri_string(),"",true);
                break;
            case 'detail_add':
                $data['title'] = "Warehouse Management: Returns: Detail Add";
                $this->load->vars($data);
                $this->data['content'] = $this->load->view("app/".$this->uri->segment(2)."/".$this->uri->segment(3)."/details-add","",true);
                break;
            case 'detail_update':
                $data['title'] = "Warehouse Management: Returns: Detail Edit";
                $this->load->vars($data);
                $this->data['content'] = $this->load->view("app/".$this->uri->segment(2)."/".$this->uri->segment(3)."/details-update","",true);
                break;
            default:
                redirect(base_url()."error", 'refresh');
                break;
        }

        $this->load->view("templates/container", $this->data);
    }


}
