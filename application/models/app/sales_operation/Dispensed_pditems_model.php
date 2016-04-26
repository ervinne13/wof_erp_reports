<?php

/**
 * Description of Dispensed Redemtion Ticket
 * Date Created 3/21/2016 8:00 PM
 * @author Michelle De Mesa
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dispensed_pditems_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_DispensedPDItems");
    }

    public function getPreviousDocs($pditems, $machine, $week, $location) {

        $this->db->select("*");
        $this->db->where(array(
            'DIP_DI_DocNo'                => $pditems["DI_DocNo"],
            'DIP_MachineTag'              => $machine['MCI_MC_MachineTag'],
            'DIP_WeekNo'                  => $week,
            'DATE("DIP_RetrievalDate") <' => $pditems['DI_RetrievalDate']
        ));

        $result = $this->db->get("tblINV_DispensedPDItems");

        return $result->result_array();
    }

    public function getDocs($dispense, $machine_tag, $week) {

        $this->db->select("*");
        $this->db->where(array(
            'DIP_DI_DocNo'   => $dispense["DI_DocNo"],
            'DIP_MachineTag' => $machine_tag,
            'DIP_WeekNo'     => $week
        ));
        $this->db->order_by('"DIP_LineNo"', 'ASC');

        $result = $this->db->get("tblINV_DispensedPDItems");

        return $result->result_array();
    }

    /**
     * Creates dp item documents from unprocessed machine items and returns the number
     * of documents created
     * @param type $dispense
     * @param type $machine_id
     * @param type $week
     * @param type $location
     * @param type $consolidate
     * @return int
     *  The number of documents created
     * @throws Exception
     */
    public function createDocsFromUnprocessedMachineItems($dispense, $machine_id, $week, $location, $consolidate = FALSE) {

        //  get unprocessed machine items
        $unprocessed_machine_items_condition = array(
            'md5("MCI_MC_MachineTag")' => $machine_id,
            'MCI_Location'             => $location,
            'MCI_DPItemCreated'        => '0',
            'MCI_Remaining !='         => 0
        );

        $unprocessed_machine_items_query = $this->db->select('*')
                ->where($unprocessed_machine_items_condition)
                ->get('"tblINV_MachineItems"');

        $unprocessed_machine_items = $unprocessed_machine_items_query->result_array();

        if (count($unprocessed_machine_items) > 0) {
            //  create data to insert            
            $consolidated_doc_map = $this->_createDocsFromMachineItems($dispense, $unprocessed_machine_items, $week, $location, $consolidate);

            $this->db->trans_start();

            //  insert data
            foreach ($consolidated_doc_map AS $doc) {
                $this->add_data($doc);
            }

            //  update item created flag on machine items
            $updates = array(
                '"MCI_DPItemCreated"' => '1'
            );
            $this->db->where($unprocessed_machine_items_condition)
                    ->update('"tblINV_MachineItems"', update_data($updates));

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception("SQL Exception, failed to create dp items");
            } else {
                $this->db->trans_commit();

                return count($consolidated_doc_map);
            }
        } else {
            return 0;
        }
    }

    private function _createDocsFromMachineItems($dispense, $machine_items, $week, $location, $consolidate = FALSE) {

        $consolidated_docs = array();

        foreach ($machine_items AS $item) {

            $item_no = $item["MCI_ItemNo"];

            if ($consolidate && array_key_exists($item_no, $consolidated_docs)) {
                //  consolidate
                $consolidated_docs[$item_no]["DIP_Beg"] += $item['MCI_Remaining'];
                $consolidated_docs[$item_no]["DIP_Captured"] += $item['MCI_Remaining'];
            } else {

                $doc = array(
                    'DIP_DI_DocNo'      => $dispense["DI_DocNo"],
                    'DIP_WeekNo'        => $week,
                    'DIP_Location'      => $location,
                    "DIP_ItemNo"        => $item['MCI_ItemNo'],
                    "DIP_MachineTag"    => $item['MCI_MC_MachineTag'],
                    "DIP_MachineNo"     => $item['MCI_MC_IM_Item_id'],
                    "DIP_Beg"           => $item['MCI_Remaining'],
                    "DIP_End"           => 0,
                    "DIP_Captured"      => $item['MCI_Remaining'],
                    "DIP_RetrievalDate" => $dispense['DI_RetrievalDate'],
                    "DIP_Retrieved"     => '0',
                );

                if ($consolidate) {
                    //  create
                    $consolidated_docs[$item_no] = $doc;
                } else {
                    array_push($consolidated_docs, $doc);
                }
            }
        }

        return $consolidated_docs;
    }

    public function findOrCreateDoc($dispense, $machine_item, $week, $location) {

        $pditems_condition = array(
            'DIP_DI_DocNo'   => $dispense["DI_DocNo"],
            'DIP_MachineTag' => $machine_item['MCI_MC_MachineTag'],
            'DIP_LineNo'     => $machine_item['MCI_LineNo'],
            'DIP_ItemNo'     => $machine_item['MCI_ItemNo'],
            'DIP_WeekNo'     => $week,
            'DIP_Location'   => $location,
            'DIP_MachineNo'  => $machine_item['MC_IM_Item_id']
        );

        $pditems = $this->get_spec_data_row($pditems_condition);

        if (!$pditems) {

            $initial_data = $pditems_condition;

            $initial_data["DIP_DI_DocNo"]      = $dispense["DI_DocNo"];
            $initial_data["DIP_MachineTag"]    = $machine_item['MCI_MC_MachineTag'];
            $initial_data["DIP_MachineNo"]     = $machine_item['MC_IM_Item_id'];
            $initial_data["DIP_WeekNo"]        = $week;
            $initial_data["DIP_Location"]      = $location;
            $initial_data["DIP_Beg"]           = $machine_item['MCI_Remaining'];
            $initial_data["DIP_End"]           = 0;
            $initial_data["DIP_Captured"]      = $machine_item['MCI_Remaining'];
            $initial_data["DIP_RetrievalDate"] = $dispense['DI_RetrievalDate'];
            $initial_data["DIP_Retrieved"]     = '0';


            $this->add_data($initial_data);
            // echo $this->db->last_query();
            $pditems = $this->get_spec_data_row($pditems_condition);
        }

        return $pditems;
    }

    public function updatePDItems($items) {

        $this->db->trans_begin();

        foreach ($items AS $item_update) {

            $condition = array(
                'DIP_ItemNo'            => $item_update['DIP_ItemNo'],
                'md5("DIP_MachineTag")' => $item_update['DIP_MachineTag'],
                'DIP_DI_DocNo'          => $item_update['DIP_DI_DocNo']
            );

            $this->db->select("*");
            $this->db->where($condition);
            $this->db->order_by('"DIP_LineNo"', 'ASC');
            $dispensed_pd_items_query = $this->db->get("tblINV_DispensedPDItems");
            $dispensed_pd_items       = $dispensed_pd_items_query->result_array();

            $dispensed_pd_items_updates = array();
            $remaining_dispensed        = $item_update["DIP_Captured"];

            foreach ($dispensed_pd_items AS $old_item) {

                if ($remaining_dispensed <= 0) {
                    break;
                }

                $old_item_condition = array(
                    "DIP_LineNo" => $old_item["DIP_LineNo"]
                );

                if ($old_item["DIP_Beg"] <= $remaining_dispensed) {
                    array_push($dispensed_pd_items_updates, array(
                        "condition" => $old_item_condition,
                        "updates"   => array(
                            "DIP_End"      => 0,
                            "DIP_Captured" => $old_item["DIP_Beg"]
                        )
                    ));

                    $remaining_dispensed -= $old_item["DIP_Beg"];
                } else {
                    array_push($dispensed_pd_items_updates, array(
                        "condition" => $old_item_condition,
                        "updates"   => array(
                            "DIP_End"      => $old_item["DIP_Beg"] - $remaining_dispensed,
                            "DIP_Captured" => $remaining_dispensed
                        )
                    ));

                    $remaining_dispensed = 0;
                    break;
                }
            }

            echo "===================================";
            var_dump($dispensed_pd_items_updates);

            foreach ($dispensed_pd_items_updates AS $updates) {
                $this->update_data($updates["condition"], $updates["updates"]);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function finalize($dispense, $week) {

        $this->db->select("*");
        $this->db->where(array(
            'DIP_DI_DocNo'              => $dispense["DI_DocNo"],
            'DIP_WeekNo'                => $week,
            'DATE("DIP_RetrievalDate")' => $dispense['DI_RetrievalDate']
        ));

        $this->db->order_by('"DIP_LineNo"', 'ASC');

        $dispensed_pd_items_query = $this->db->get("tblINV_DispensedPDItems");
        $dispensed_pd_items       = $dispensed_pd_items_query->result_array();

        //  consolidate capture/dispense count
        $consolidated_dispense_count_map = array();

        foreach ($dispensed_pd_items AS $item) {
            $item_no = $item["DIP_ItemNo"];

            if (array_key_exists($item_no, $consolidated_dispense_count_map)) {
                $consolidated_dispense_count_map[$item_no]["DIP_Captured"] += $item["DIP_Captured"];
            } else {
                $consolidated_dispense_count_map[$item_no] = array(
                    "DIP_MachineTag" => $item["DIP_MachineTag"],
                    "DIP_Captured"   => $item["DIP_Captured"],
                );
            }
        }

        //  set MCI_Remaining = MCI_Remaining - DIP_Captured
        //  set MCI_DPItemCreated = 0        
        $this->db->trans_begin();

        foreach ($consolidated_dispense_count_map AS $item_no => $dispense_count) {

            $machine_tag = $dispense_count["DIP_MachineTag"];

            $machine_items_condition = array(
                "MCI_DPItemCreated" => '1',
                "MCI_ItemNo"        => $item_no,
                "MCI_MC_MachineTag" => $machine_tag
            );

            $machine_items_query = $this->db->select('*')
                    ->where($machine_items_condition)
                    ->get('"tblINV_MachineItems"')
            ;

            $machine_items         = $machine_items_query->result_array();
            $machine_items_updates = array();

            $remaining_capture_count = $dispense_count["DIP_Captured"];

            foreach ($machine_items AS $machine_item) {

                $machine_item_condition = array(
                    "MCI_DPItemCreated" => '1',
                    "MCI_LineNo"        => $machine_item["MCI_LineNo"],
                    "MCI_MC_MachineTag" => $machine_item["MCI_MC_MachineTag"]
                );

                if ($machine_item["MCI_Remaining"] >= $remaining_capture_count) {
                    array_push($machine_items_updates, array(
                        "condition" => $machine_item_condition,
                        "updates"   => array(
                            "MCI_Remaining" => $machine_item["MCI_Remaining"] - $remaining_capture_count
                        )
                    ));
                    //  this is the last machine that needs its MCI_Remaining deducted
                    break;
                } else {
                    //  set the current machine item to 0 and then move on to the next machine
                    array_push($machine_items_updates, array(
                        "condition" => $machine_item_condition,
                        "updates"   => array(
                            "MCI_Remaining" => 0
                        )
                    ));

                    $remaining_capture_count -= $machine_item["MCI_Remaining"];
                }
            }

//            var_dump($machine_items_updates);
            //  set MCI_Remaining = MCI_Remaining - DIP_Captured
            foreach ($machine_items_updates AS $machine_items_update) {
                $this->db->where($machine_items_update["condition"])
                        ->update('"tblINV_MachineItems"', update_data($machine_items_update["updates"]));
            }
        }

        foreach ($consolidated_dispense_count_map AS $item_no => $dispense_count) {
            $machine_tag = $dispense_count["DIP_MachineTag"];

            $update = array(
                "MCI_DPItemCreated" => '0'
            );

            $condition = array(
                "MCI_ItemNo"        => $item_no,
                "MCI_MC_MachineTag" => $machine_tag
            );

            //  set MCI_DPItemCreated = 0
            $this->db->where($condition)->update('"tblINV_MachineItems"', update_data($update));
        }

        //  update header
        $this->db->where(array(
            'DI_DocNo'  => $dispense["DI_DocNo"],
            'DI_WeekNo' => $week,
        ));

        $new_week = $week + 1;

        if ($new_week >= 5 || $new_week <= 0) {
            $new_week = 0;
        }

        $this->db->update('"tblINV_Dispensed"', array(
            "DI_WeekNo" => $new_week
        ));

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

}
