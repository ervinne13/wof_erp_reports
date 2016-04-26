<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Retrieval_summary_facade
 *
 * @author Ervinne Sodusta
 */
class Retrieval_summary_facade extends MY_Model {

    protected $ttp_assumptions_model;
    protected $retrieval_summary_model;
    protected $retrieval_summary_detail_model;

    const TABLE_RETRIEVAL_SUMMARY         = "tblINV_RetrievalSummary";
    const TABLE_RETRIEVAL_SUMMARY_DETAILS = "tblINV_RetrievalSummaryDetails";

    public function initialize($ttp_assumptions_model, $retrieval_summary_model, $retrieval_summary_detail_model) {
        $this->ttp_assumptions_model          = $ttp_assumptions_model;
        $this->retrieval_summary_model        = $retrieval_summary_model;
        $this->retrieval_summary_detail_model = $retrieval_summary_detail_model;
    }

    /**
     * 
     * @param type $rv
     * @param type $source_entry
     * @param integer $entry_type 
     *              0 - Token
     *              1 - Piso Token
     *              2 - Piso Coin
     *              3 - Ticket
     */
    public function updateSummary($rv, $source_entry, $entry_type) {

        $this->db->trans_start(TRUE);
        $adapted_source_entry = $this->adaptSourceEntry($rv["RV_Location"], $source_entry, $entry_type);

        $summary_header = $this->retrieval_summary_model->find($rv["RV_DocNo"], $rv["RV_Week"]);

        if ($summary_header) {
            //  update header
            $this->updateSummary($rv, $adapted_source_entry, $entry_type);
        } else {
            //  create the header with the source entry data
            $this->createSummaryHeader($rv, $adapted_source_entry, $entry_type);
        }

        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE) {
            throw new Exception("Transaction failed");
        }
    }

    public function adaptSourceEntry($location, $source_entry, $entry_type) {

        $prefixes = array(
            "RVT",
            "RVPT",
            "RVPC",
            "RVTR",
        );

        $assumption = $this->ttp_assumptions_model->find($location, $entry_type);
        $price      = $assumption["TTP_Price"];

        $qty_retrieved = $source_entry[$prefixes[$entry_type] . "_QtyRetrieved"];

        $adapted_source_entry = array(
            "qty_retrieved" => $qty_retrieved,
            "price"         => $price,
            "total"         => $qty_retrieved * $price
        );

        return $adapted_source_entry;
    }

    public function createSummaryHeader($rv, $adapted_source_entry, $entry_type) {
        $header = array(
            'RVS_RV_DocNo'  => $rv["RV_DocNo"],
            'RVS_WeekNo'    => $rv["RV_Week"],
            'RVS_Token'     => 0,
            'RVS_PisoToken' => 0,
            'RVS_PisoCoin'  => 0,
            'RVS_Ticket'    => 0,
            'RVS_Total'     => 0
        );

        $this->getHeaderUpdate($header, $adapted_source_entry, $entry_type);

        $this->db->insert(Retrieval_summary_facade::TABLE_RETRIEVAL_SUMMARY, $header);
    }

    public function updateSummaryHeader($rv, $adapted_source_entry, $entry_type) {
        $header = array();
        $this->getHeaderUpdate($header, $adapted_source_entry, $entry_type);

        $where = array(
            'RVS_RV_DocNo' => $rv["RV_DocNo"],
            'RVS_WeekNo'   => $rv["RV_Week"]
        );

        $this->db
                ->where($where)
                ->update(Retrieval_summary_facade::TABLE_RETRIEVAL_SUMMARY, $header);
    }

    public function getHeaderUpdate(&$header, $adapted_source_entry, $entry_type) {
        switch ($entry_type) {
            case 0:
                $header["RVS_Token"]     = $adapted_source_entry["qty_retrieved"];
                break;
            case 1:
                $header["RVS_PisoToken"] = $adapted_source_entry["qty_retrieved"];
                break;
            case 2:
                $header["RVS_PisoCoin"]  = $adapted_source_entry["qty_retrieved"];
                break;
            case 3:
                $header["RVS_Ticket"]    = $adapted_source_entry["qty_retrieved"];
                break;
        }

        $header["RVS_Total"] = $adapted_source_entry["total"];

        return $header;
    }

    public function findOrCreateSummaryDetails($rv, $type) {

        $summary_detail = $this->retrieval_summary_detail_model->find($rv["RV_DocNo"], $rv["RV_Week"]);

        if (!$summary_detail) {
            //  create detail

            $detail = array(
                'RVSD_RVS_RV_DocNo' => $rv["RV_DocNo"],
                'RVSD_RVS_WeekNo'   => $rv["RV_Week"],
                'RVSD_Type'         => $type,
                'RVSD_Qty'          => $type,
            );

            $summary_detail = $this->retrieval_summary_detail_model->find($rv["RV_DocNo"], $rv["RV_Week"]);
        }

        return $summary_detail;
    }

}
