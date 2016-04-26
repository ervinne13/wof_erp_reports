<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_ticket_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalTicket");
    }

    public function getWeeklyTotals($doc_no, $machine_tag) {
        $result = $this->db->select(" 
        (SELECT SUM(\"RVTR_QtyRetrieved\") FROM \"tblINV_RetrievalTicket\" WHERE \"RVTR_MachineTag\" = '{$machine_tag}' AND \"RVTR_RV_DocNo\" = '{$doc_no}' AND \"RVTR_WeekNo\" = 1) AS \"QtyRetrievedWeek1\",
        (SELECT SUM(\"RVTR_QtyRetrieved\") FROM \"tblINV_RetrievalTicket\" WHERE \"RVTR_MachineTag\" = '{$machine_tag}' AND \"RVTR_RV_DocNo\" = '{$doc_no}' AND \"RVTR_WeekNo\" = 2) AS \"QtyRetrievedWeek2\",
        (SELECT SUM(\"RVTR_QtyRetrieved\") FROM \"tblINV_RetrievalTicket\" WHERE \"RVTR_MachineTag\" = '{$machine_tag}' AND \"RVTR_RV_DocNo\" = '{$doc_no}' AND \"RVTR_WeekNo\" = 3) AS \"QtyRetrievedWeek3\",
        (SELECT SUM(\"RVTR_QtyRetrieved\") FROM \"tblINV_RetrievalTicket\" WHERE \"RVTR_MachineTag\" = '{$machine_tag}' AND \"RVTR_RV_DocNo\" = '{$doc_no}' AND \"RVTR_WeekNo\" = 4) AS \"QtyRetrievedWeek4\"
        ")->get();

        return $result->row_array();
    }

    public function getPreviousDocs($retrieval, $machine, $week) {

        $this->db->select("*");
        $this->db->where(array(
            'RVTR_RV_DocNo'       => $retrieval["RV_DocNo"],
            'RVTR_MachineTag'     => $machine['MC_MachineTag'],
            'RVTR_WeekNo'         => $week,
            'DATE("RVTR_Date") <' => $retrieval['RV_RetrievalDate']
        ));

        $result = $this->db->get("tblINV_RetrievalTicket");
        return $result->result_array();
    }

    public function findOrCreateDocs($retrieval, $machine, $week) {

        $this->db->select("TTP_Price");
        $this->db->where(array(
            'TTP_Type'       => '3',
            'TTP_SP_StoreID' => $retrieval['RV_Location']
        ));

        $prices  = $this->db->get("tblINV_TTPAssumptions")->result_array();
        $tickets = array();

        foreach ($prices AS $price) {
            array_push($tickets, $this->findOrCreateDoc($retrieval, $machine, $week, $price["TTP_Price"]));
        }

        return $tickets;
    }

    public function findOrCreateDoc($retrieval, $machine, $week, $ticket_price) {

        $condition = array(
            'RVTR_RV_DocNo'    => $retrieval["RV_DocNo"],
            'RVTR_MachineTag'  => $machine['MC_MachineTag'],
            'RVTR_WeekNo'      => $week,
            'RVTR_Date'        => $retrieval['RV_RetrievalDate'],
            'RVTR_TicketPrice' => $ticket_price,
        );

        $retrieval_ticket = $this->get_spec_data_row($condition);

        if (!$retrieval_ticket) {

            $initial_data                      = $condition;
            $initial_data["RVTR_TicketPrice"]  = $ticket_price;
            $initial_data["RVTR_QtyRetrieved"] = 0;

            $this->add_data($initial_data);
            $retrieval_ticket = $this->get_spec_data_row($condition);
        }

        return $retrieval_ticket;
    }

}
