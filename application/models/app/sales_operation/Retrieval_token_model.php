<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_token_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalToken");
    }

    public function findDoc($retrieval, $machine, $week) {
        $retrieval_token_condition = array(
            'RVT_RV_DocNo'   => $retrieval["RV_DocNo"],
            'RVT_MachineTag' => $machine['MC_MachineTag'],
            'RVT_WeekNo'     => $week,
            'RVT_Date'       => $retrieval['RV_RetrievalDate']
        );

        return $this->get_spec_data_row($retrieval_token_condition);
    }

    public function getWeeklyTotals($doc_no, $machine_tag) {
        $result = $this->db->select(" 
        (SELECT SUM(\"RVT_QtyRetrieved\") FROM \"tblINV_RetrievalToken\" WHERE \"RVT_MachineTag\" = '{$machine_tag}' AND \"RVT_RV_DocNo\" = '{$doc_no}' AND \"RVT_WeekNo\" = 1) AS \"QtyRetrievedWeek1\",
        (SELECT SUM(\"RVT_QtyRetrieved\") FROM \"tblINV_RetrievalToken\" WHERE \"RVT_MachineTag\" = '{$machine_tag}' AND \"RVT_RV_DocNo\" = '{$doc_no}' AND \"RVT_WeekNo\" = 2) AS \"QtyRetrievedWeek2\",
        (SELECT SUM(\"RVT_QtyRetrieved\") FROM \"tblINV_RetrievalToken\" WHERE \"RVT_MachineTag\" = '{$machine_tag}' AND \"RVT_RV_DocNo\" = '{$doc_no}' AND \"RVT_WeekNo\" = 3) AS \"QtyRetrievedWeek3\",
        (SELECT SUM(\"RVT_QtyRetrieved\") FROM \"tblINV_RetrievalToken\" WHERE \"RVT_MachineTag\" = '{$machine_tag}' AND \"RVT_RV_DocNo\" = '{$doc_no}' AND \"RVT_WeekNo\" = 4) AS \"QtyRetrievedWeek4\"
        ")->get();

        return $result->row_array();
    }

    public function getPreviousDocs($retrieval, $machine, $week) {

        $this->db->select("*");
        $this->db->where(array(
            'RVT_RV_DocNo'       => $retrieval["RV_DocNo"],
            'RVT_MachineTag'     => $machine['MC_MachineTag'],
            'RVT_WeekNo'         => $week,
            'DATE("RVT_Date") <' => $retrieval['RV_RetrievalDate']
        ));

        $result = $this->db->get("tblINV_RetrievalToken");
        return $result->result_array();
    }

    public function findOrCreateDoc($retrieval, $machine, $week, $counter_from = 0) {

        $retrieval_token_condition = array(
            'RVT_RV_DocNo'   => $retrieval["RV_DocNo"],
            'RVT_MachineTag' => $machine['MC_MachineTag'],
            'RVT_WeekNo'     => $week,
            'RVT_Date'       => $retrieval['RV_RetrievalDate']
        );

        $retrieval_token = $this->get_spec_data_row($retrieval_token_condition);

        if (!$retrieval_token) {

            $initial_data = $retrieval_token_condition;

            $initial_data["RVT_CounterFrom"]  = $counter_from;
            $initial_data["RVT_CounterTo"]    = 0;
            $initial_data["RVT_QtyRetrieved"] = 0;
            $initial_data["RVT_Free"]         = 0;
            $initial_data["RVT_MTC"]          = 0;

            $this->add_data($initial_data);
            $retrieval_token = $this->get_spec_data_row($retrieval_token_condition);
        }

        return $retrieval_token;
    }

}
