<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_token_variance_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalTokenVariance");
    }

    public function getRecords($doc_no, $week) {

        $where = array(
            'RVTOV_RV_DocNo' => $doc_no,
            'RVTOV_WeekNo'   => $week,
        );

        $records = $this->get_spec_data_array($where);

        if ($records && $records['data']) {
            return $records['data'];
        } else {
            return $records;
        }
    }

    private function _getInitialData($retrieval, $week, $particular, $qty_retrieved) {
        return array(
            'RVTOV_RV_DocNo'      => $retrieval["RV_DocNo"],
            'RVTOV_RetrievalDate' => $retrieval["RV_RetrievalDate"],
            'RVTOV_WeekNo'        => $week,
            'RVTOV_Particular'    => $particular,
            'RVTOV_QtyRetrieved'  => $qty_retrieved,
            'RVTOV_Released'      => 0,
            'RVTOV_VarianceQty'   => 0,
            'RVTOV_VarianceP'     => 0,
        );
    }

    private function _getCondition($retrieval, $week, $particular) {
        return array(
            'RVTOV_RV_DocNo'      => $retrieval["RV_DocNo"],
            'RVTOV_RetrievalDate' => $retrieval["RV_RetrievalDate"],
            'RVTOV_WeekNo'        => $week,
            'RVTOV_Particular'    => $particular
        );
    }

    public function find($retrieval, $week, $particular) {
        return $this->get_spec_data_row($this->_getCondition($retrieval, $week, $particular));
    }

    function getTotalToken($date) {

        $token_total_where = array(
            "RVT_Date" => $date
        );

        $token_total_result = $this->db->select('SUM("RVT_QtyRetrieved") AS "QtyRetrieved"')
                ->where($token_total_where)
                ->get("tblINV_RetrievalToken")
                ->row_array();

        if ($token_total_result) {
            $token_total = $token_total_result['QtyRetrieved'];
        } else {
            $token_total = 0;
        }

        return $token_total;
    }

    function getPisoTotalToken($date) {

        $piso_token_total_where = array(
            "RVPT_Date" => $date
        );

        $piso_token_total_result = $this->db->select('SUM("RVPT_QtyRetrieved") AS "QtyRetrieved"')
                ->where($piso_token_total_where)
                ->get("tblINV_RetrievalPisoToken")
                ->row_array();

        if ($piso_token_total_result) {
            $piso_token_total = $piso_token_total_result['QtyRetrieved'];
        } else {
            $piso_token_total = 0;
        }

        return $piso_token_total;
    }

    public function createOrUpdateDocs($retrieval, $week) {

        $token      = $this->find($retrieval, $week, 'Token');
        $piso_token = $this->find($retrieval, $week, 'Piso Token');

        $token_total      = $this->getTotalToken($retrieval["RV_RetrievalDate"]);
        $piso_token_total = $this->getPisoTotalToken($retrieval["RV_RetrievalDate"]);

        if (!$token_total) {
            $token_total = 0;
        }

        if (!$piso_token_total) {
            $piso_token_total = 0;
        }
        
        if (!$token) {
            //  create
            $new_token = $this->_getInitialData($retrieval, $week, 'Token', $token_total);
            $this->add_data($new_token);
        } else {
            //  update
            $condition = $this->_getCondition($retrieval, $week, 'Token');
            $update    = array(
                'RVTOV_QtyRetrieved' => $token_total
            );
            $this->update_data($condition, $update);
        }

        if (!$piso_token) {
            //  create
            $new_piso_token = $this->_getInitialData($retrieval, $week, 'Piso Token', $piso_token_total);
            $this->add_data($new_piso_token);
        } else {
            //  update
            $condition = $this->_getCondition($retrieval, $week, 'Piso Token');
            $update    = array(
                'RVTOV_QtyRetrieved' => $piso_token_total
            );
            $this->update_data($condition, $update);
        }

        return array($token, $piso_token);
    }

}
