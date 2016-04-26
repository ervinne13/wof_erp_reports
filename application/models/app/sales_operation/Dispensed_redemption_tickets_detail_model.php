<?php

/**
 * Description of Dispensed Redemtion Ticket
 * Date Created 2/21/2016 8:00 PM
 * @author Michelle De Mesa
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dispensed_redemption_tickets_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_DispensedTicket");
    }

    public function findDoc($dispense, $machine, $week, $location) {

        $dispense_redem_ticket_condition = array(
            'DIT_DI_DocNo'   => $dispense["DI_DocNo"],
            'DIT_MachineTag' => $machine['MCT_MC_MachineTag'],
            'DIT_DeckNo'     => $machine['MCT_DeckNo'],
            'DIT_WeekNo'     => $week,
            'DIT_Location'   => $location
                // 'DIT_RetrievalDate'     => $dispense['DI_RetrievalDate']
        );

        return $this->get_spec_data_row($dispense_redem_ticket_condition);
    }

    public function getPreviousDocs($dispense, $machine, $week, $location) {

        $this->db->select("*");
        $this->db->where(array(
            'DIT_DI_DocNo'                => $dispense["DI_DocNo"],
            'DIT_MachineTag'              => $machine['MCT_MC_MachineTag'],
            'DIT_WeekNo'                  => $week,
            'DATE("DIT_RetrievalDate") <' => $dispense['DI_RetrievalDate']
        ));

        $result = $this->db->get("tblINV_DispensedTicket");
        return $result->result_array();
    }

    public function findOrCreateDoc($dispense, $machine_item, $week, $location) {

        //DISPENSE TICKET QTY ISSUED

        $qtyissue = $machine_item['MCT_SeriesTo'] - $machine_item['MCT_SeriesFrom'] + 1;

        // TOTAL REMAINING    	
        $totalRemaining = $machine_item['MCT_SeriesTo'] - $machine_item['MCT_SeriesFrom'] + 1 - $qtyissue;

        if ($machine_item["MCT_Retrieved"] = NULL) {
            $Retrieved = '1';
        } else {
            $Retrieved = '0';
        }

        $dispense_ticket_condition = array(
            'DIT_DI_DocNo'   => $dispense["DI_DocNo"],
            'DIT_MachineTag' => $machine_item['MCT_MC_MachineTag'],
            'DIT_WeekNo'     => $week,
            'DIT_Location'   => $location,
            'DIT_DeckNo'     => $machine_item['MCT_DeckNo'],
            "DIT_SerialFrom" => $machine_item['MCT_SeriesFrom'],
            "DIT_SerialTo"   => $machine_item['MCT_SeriesTo']
        );

        $dispense_ticket = $this->get_spec_data_row($dispense_ticket_condition);

        // echo json_encode($dispense_ticket);


        if (!$dispense_ticket) {

            $initial_data = $dispense_ticket_condition;

            $initial_data["DIT_DI_DocNo"]      = $dispense["DI_DocNo"];
            $initial_data["DIT_MachineTag"]    = $machine_item['MCT_MC_MachineTag'];
            $initial_data["DIT_WeekNo"]        = $week;
            $initial_data["DIT_Location"]      = $location;
            $initial_data["DIT_SerialFrom"]    = $machine_item['MCT_SeriesFrom'];
            $initial_data["DIT_SerialTo"]      = $machine_item['MCT_SeriesTo'];
            $initial_data["DIT_Reading"]       = 0;
            $initial_data["DIT_DeckNo"]        = $machine_item['MCT_DeckNo'];
            $initial_data["DIT_QtyIssued"]     = $qtyissue;
            $initial_data["DIT_MachineNo"]     = $machine_item['MC_IM_Item_id'];
            $initial_data["DIT_Remaining"]     = $totalRemaining;
            $initial_data["DIT_RetrievalDate"] = $dispense['DI_RetrievalDate'];
            $initial_data["DIT_Retrieved"]     = '0';


            $this->add_data($initial_data);
            // echo $this->db->last_query();
            $dispense_ticket = $this->get_spec_data_row($dispense_ticket_condition);
        }


        return $dispense_ticket;
    }

    public function getDocs($dispense, $machine_tag, $week) {
        $this->db->select('"DIT_LineNo", "tblINV_MachineTickets"."MCT_DocDate", "tblINV_DispensedTicket".*');
        $this->db->join('"tblINV_MachineTickets"', '"tblINV_MachineTickets"."MCT_MC_MachineTag" = "tblINV_DispensedTicket"."DIT_MachineTag"', 'left');
        $this->db->where(array(
            'DIT_DI_DocNo'              => $dispense["DI_DocNo"],
            'DIT_MachineTag'            => $machine_tag,
            'DIT_WeekNo'                => $week,
            'DATE("DIT_RetrievalDate")' => $dispense['DI_RetrievalDate']
        ));

        $this->db->group_by(array('"DIT_LineNo"', 'MCT_DocDate"', '"DIT_DI_DocNo"'));
        $this->db->order_by('"tblINV_MachineTickets"."MCT_DocDate"', "desc");

        $result = $this->db->get("tblINV_DispensedTicket");

        return $result->result_array();
    }

}
