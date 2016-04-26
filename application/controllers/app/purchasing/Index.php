<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author ervinne
 */
class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!is_logged_in()['status']) {
            redirect(site_url());
        }

        $data['title']     = "Purchasing";
        $data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');
        $this->load->vars($data);
        $this->data        = array('header' => $this->load->view("templates/header", "", true),
            'footer' => $this->load->view("templates/footer", "", true),
            'navs'   => $this->load->view('templates/side-nav', "", true),
            'head'   => $this->load->view("templates/head-nav", "", true),
        );
    }

    public function index() {
        $data['title']         = "Purchasing";
        $this->data['content'] = $this->load->view(uri_string() . '/index', $data, true);
        return $this->load->view("templates/container", $this->data);
    }

    public function print_document($id) {
        $this->load->library('Pdf');

        $this->load->model('app/financial_management/reimbursement_model');
        $this->load->model('app/financial_management/reimbursement_detail_model');

        $data['header']  = $this->reimbursement_model->get_spec_data_row(array('md5("RE_DocNo")' => $id));
        $data['details'] = $this->reimbursement_detail_model->get_spec_data_array(array('md5("RED_RE_DocNo")' => $id));

        $opts = array('content'  => $this->load->view('app/financial-management/reimbursement/printout', $data, true),
            'type'     => 'I',
            'filename' => 'export-' . date('Ymdhis') . '-' . uniqid() . '.pdf',
            'path'     => 'pdf/');

        $this->pdf->generate($opts);
    }

}
