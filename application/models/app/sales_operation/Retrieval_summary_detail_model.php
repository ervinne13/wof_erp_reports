<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Retrieval_summary_detail_model
 *
 * @author Ervinne Sodusta
 */
class Retrieval_summary_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalSummaryDetails");
    }

    public function find($doc_no, $week_no) {
        $condition = array(
            'RVSD_RVS_RV_DocNo' => $doc_no,
            'RVSD_RVS_WeekNo'   => $week_no,
        );

        return $this->get_spec_data_row($condition);
    }

}
