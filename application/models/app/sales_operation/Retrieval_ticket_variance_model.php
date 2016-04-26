<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retrieval_ticket_variance_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_RetrievalTicketVariance");
    }

    public function getRecords($doc_no, $week) {

        $where = array(
            'RVTIV_RV_DocNo' => $doc_no,
            'RVTIV_WeekNo'   => $week,
        );

        $records = $this->get_spec_data_array($where);

        if ($records && $records['data']) {
            return $records['data'];
        } else {
            return $records;
        }
    }

    private function _getInitialData($retrieval, $week, $ticket_price, $qty_retrieved) {
        return array(
            'RVTIV_RV_DocNo'     => $retrieval["RV_DocNo"],
            'RVTIV_Date'         => $retrieval["RV_RetrievalDate"],
            'RVTIV_WeekNo'       => $week,
            'RVTIV_TicketPrice'  => $ticket_price,
            'RVTIV_QtyRetrieved' => $qty_retrieved,
            'RVTIV_Sold'         => 0,
            'RVTIV_VarianceQty'  => 0,
            'RVTIV_VarianceP'    => 0,
        );
    }

    private function _getCondition($retrieval, $week, $ticket_price) {
        return array(
            'RVTIV_RV_DocNo'    => $retrieval["RV_DocNo"],
            'RVTIV_Date'        => $retrieval["RV_RetrievalDate"],
            'RVTIV_WeekNo'      => $week,
            'RVTIV_TicketPrice' => $ticket_price
        );
    }

    public function find($retrieval, $week, $ticket_price) {
        return $this->get_spec_data_row($this->_getCondition($retrieval, $week, $ticket_price));
    }

    function getTotalQtyRetrieved($date, $ticket_price) {

        $condition = array(
            'RVTR_Date'        => $date,
            'RVTR_TicketPrice' => $ticket_price
        );

        $ticket_total_result = $this->db->select('SUM("RVTR_QtyRetrieved") AS "QtyRetrieved"')
                ->where($condition)
                ->get("tblINV_RetrievalTicket")
                ->row_array();


        if ($ticket_total_result) {
            $ticket_total = $ticket_total_result['QtyRetrieved'];
        } else {
            $ticket_total = 0;
        }

        return $ticket_total;
    }

    public function createOrUpdateDocs($retrieval, $week) {

        $this->db->select("TTP_Price");
        $this->db->where(array(
            'TTP_Type'       => '3',
            'TTP_SP_StoreID' => $retrieval['RV_Location']
        ));

        $prices          = $this->db->get("tblINV_TTPAssumptions")->result_array();
        $updated_tickets = array();

        foreach ($prices AS $price) {
            $ticket_price = $price["TTP_Price"];

            $ticket       = $this->find($retrieval, $week, $ticket_price);
            $ticket_total = $this->getTotalQtyRetrieved($retrieval['RV_RetrievalDate'], $ticket_price);

            if (!$ticket) {
                //  create
                $new_ticket = $this->_getInitialData($retrieval, $week, $ticket_price, $ticket_total);
                $this->add_data($new_ticket);
            } else {
                //  update
                $condition = $this->_getCondition($retrieval, $week, $ticket_price);
                $update    = array(
                    'RVTIV_QtyRetrieved' => $ticket_total
                );
                $this->update_data($condition, $update);
            }

            array_push($updated_tickets, $this->find($retrieval, $week, $ticket_price));
        }

        return $updated_tickets;
    }

}
