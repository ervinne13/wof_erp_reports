<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_piso_token_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalPisoToken");
    }

    public function getPreviousDocs($retrieval, $machine, $week) {

        $this->db->select("*");
        $this->db->where(array(
            'RVPT_RV_DocNo'       => $retrieval["RV_DocNo"],
            'RVPT_MachineTag'     => $machine['MC_MachineTag'],
            'RVPT_WeekNo'         => $week,
            'DATE("RVPT_Date") <' => $retrieval['RV_RetrievalDate']
        ));

        $result = $this->db->get("tblINV_RetrievalPisoToken");
        return $result->result_array();
    }

    public function getWeeklyTotals($doc_no, $machine_tag) {
        $result = $this->db->select(" 
        (SELECT SUM(\"RVPT_QtyRetrieved\") FROM \"tblINV_RetrievalPisoToken\" WHERE \"RVPT_MachineTag\" = '{$machine_tag}' AND \"RVPT_RV_DocNo\" = '{$doc_no}' AND \"RVPT_WeekNo\" = 1) AS \"QtyRetrievedWeek1\",
        (SELECT SUM(\"RVPT_QtyRetrieved\") FROM \"tblINV_RetrievalPisoToken\" WHERE \"RVPT_MachineTag\" = '{$machine_tag}' AND \"RVPT_RV_DocNo\" = '{$doc_no}' AND \"RVPT_WeekNo\" = 2) AS \"QtyRetrievedWeek2\",
        (SELECT SUM(\"RVPT_QtyRetrieved\") FROM \"tblINV_RetrievalPisoToken\" WHERE \"RVPT_MachineTag\" = '{$machine_tag}' AND \"RVPT_RV_DocNo\" = '{$doc_no}' AND \"RVPT_WeekNo\" = 3) AS \"QtyRetrievedWeek3\",
        (SELECT SUM(\"RVPT_QtyRetrieved\") FROM \"tblINV_RetrievalPisoToken\" WHERE \"RVPT_MachineTag\" = '{$machine_tag}' AND \"RVPT_RV_DocNo\" = '{$doc_no}' AND \"RVPT_WeekNo\" = 4) AS \"QtyRetrievedWeek4\"
        ")->get();

        return $result->row_array();
    }

    public function findOrCreateDoc($retrieval, $machine, $week, $counter_from = 0) {

        $retrieval_token_condition = array(
            'RVPT_RV_DocNo'   => $retrieval["RV_DocNo"],
            'RVPT_MachineTag' => $machine['MC_MachineTag'],
            'RVPT_WeekNo'     => $week,
            'RVPT_Date'       => $retrieval['RV_RetrievalDate']
        );

        $retrieval_token = $this->get_spec_data_row($retrieval_token_condition);

        if (!$retrieval_token) {

            $initial_data = $retrieval_token_condition;

            $initial_data["RVPT_CounterFrom"]  = $counter_from;
            $initial_data["RVPT_CounterTo"]    = 0;
            $initial_data["RVPT_QtyRetrieved"] = 0;
            $initial_data["RVPT_PisoCoin"]     = 0;
            $initial_data["RVPT_MTC"]          = 0;

            $this->add_data($initial_data);
            $retrieval_token = $this->get_spec_data_row($retrieval_token_condition);
        }

        return $retrieval_token;
    }

    public function findDoc($retrieval, $machine, $week) {
        $retrieval_token_condition = array(
            'RVPT_RV_DocNo'   => $retrieval["RV_DocNo"],
            'RVPT_MachineTag' => $machine['MC_MachineTag'],
            'RVPT_WeekNo'     => $week,
            'RVPT_Date'       => $retrieval['RV_RetrievalDate']
        );

        return $this->get_spec_data_row($retrieval_token_condition);
    }

}
