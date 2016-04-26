<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_meter_reading_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalMeterReading");
    }

    public function getPreviousDocs($retrieval, $machine, $week) {

        $this->db->select("*");
        $this->db->where(array(
            'RVMR_RV_DocNo'       => $retrieval["RV_DocNo"],
            'RVMR_MachineTag'     => $machine['MC_MachineTag'],
            'RVMR_WeekNo'         => $week,
            'DATE("RVMR_Date") <' => $retrieval['RV_RetrievalDate']
        ));

        $result = $this->db->get("tblINV_RetrievalMeterReading");
        return $result->result_array();
    }

    public function findByLineNo($line_no) {

        $condition = array(
            'RVMR_LineNo' => $line_no
        );

        return $this->get_spec_data_row($condition);
    }

    public function findOrCreateDoc($retrieval, $machine, $week, $meter_no, $counter_from = 0) {

        $meter_reading_condition = array(
            'RVMR_RV_DocNo'   => $retrieval["RV_DocNo"],
            'RVMR_MachineTag' => $machine['MC_MachineTag'],
            'RVMR_MeterNo'    => $meter_no,
            'RVMR_WeekNo'     => $week,
            'RVMR_Date'       => $retrieval['RV_RetrievalDate']
        );

        $meter_reading = $this->get_spec_data_row($meter_reading_condition);

        if (!$meter_reading) {

            $initial_data = $meter_reading_condition;

            $initial_data["RVMR_MeterCount"]   = 0;
            $initial_data["RVMR_ReadingFrom"]  = $counter_from;
            $initial_data["RVMR_ReadingTo"]    = 0;
            $initial_data["RVMR_QtyRetrieved"] = 0;
            $initial_data["RVMR_VarianceQty"]  = 0;
            $initial_data["RVMR_VarianceP"]    = 0;

            $this->add_data($initial_data);
            $meter_reading = $this->get_spec_data_row($meter_reading_condition);
        }

        return $meter_reading;
    }

}
