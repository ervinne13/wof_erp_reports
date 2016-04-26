<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Machine_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_Machine");
    }

    public function table_data($location, $medium = null) {
        $this->db->select(array(
                    "MC_SubLocation",
                    "MC_MachineClass",
                    "MC_MachineTag",
                    "IM_Sales_Desc",
                    'md5("MC_MachineTag") as id'
                ))
                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "left");

//        $this->db->where('MC_Location', $location);        

        if (isset($medium)) {
            $this->db->where('MC_Medium', $medium);
        } else {
            $this->db->where('MC_CoinMeter <>', 0);
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("MC_SubLocation" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("MC_MachineClass" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("MC_MachineTag" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_Sales_Desc" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%'
            ));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('tblINV_Machine.MC_MachineTag');
        }

//        $result = $this->db->query($this->db->get_compiled_select());
        $result = $this->db->get("tblINV_Machine");
//        echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function get_machine($id) {
        $this->db->select(array(
                    "MC_Location",
                    "MC_SubLocation",
                    "MC_CoinMeter",
                    "MC_MachineClass",
                    "MC_MachineTag",
                    "IM_Sales_Desc",
                    'md5("MC_IM_Item_id") as id'
                ))
                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "left")
                ->where(array(
                    'md5("MC_MachineTag")' => $id
        ));

        $result = $this->db->get("tblINV_Machine");
        return $result->row_array();
    }

    //MACHINE FILTER BY CLASS FOR DISPENSE REDEMPTION
    public function get_machine_class($location, $machineclass) {
        $this->db->select(array(
                    "MC_Location",
                    "MC_MachineClass",
                    "MC_MachineTag",
                    "IM_Sales_Desc",
                    'md5("MC_MachineTag") as id'
                ))
                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "left");

        $this->db->where('MC_Location', $location);

        if ($machineclass) {
            $this->db->where('MC_MachineClass', $machineclass);
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("MC_Location" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("MC_MachineClass" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("MC_MachineTag" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("IM_Sales_Desc" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%'
            ));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('tblINV_Machine.DateCreated DESC');
        }

        $result = $this->db->get("tblINV_Machine");

        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    public function getMachinesByLocation($location) {

        $this->db->select("*");

        $this->db->where(array(
            '"MC_Location"' => $location
        ));

        $this->db->join('"tblINV_Item"', 'IM_Item_id = MC_IM_Item_id', 'inner');
        $this->db->order_by('"MC_IM_Item_id"');

        $query = $this->db->get('"tblINV_Machine"');
        return $query->result_array();
    }

    //for dismantle
    public function get_machine_item(){

         $query = 'select DISTINCT "MC_IM_Item_id", "IM_Sales_Desc" from "tblINV_Machine" 
                    inner join "tblINV_Item" on 
                    "IM_Item_id" = "MC_IM_Item_id"
                    order by "MC_IM_Item_id" ASC';

        $result = $this->db->query($query);

       return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());
    }

    //for preventive maintenance

    public function get_machine_items(){

         $query = 'select distinct "MC_IM_Item_id", "IM_Sales_Desc" , "MC_MachineTag" from "tblINV_Machine" 
                    inner join "tblINV_Item" on 
                    "IM_Item_id" = "MC_IM_Item_id"
                    order by "IM_Sales_Desc" asc';

        $result = $this->db->query($query);

       return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());
    }

    //for dismantle

    public function get_machinetag(){

        // $itemno = $this->input->get("MC_MachineTag");

        $query = 'select distinct "MC_MachineTag","MC_MachineClass" from "tblINV_Machine"';

        $result = $this->db->query($query);

       return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());
    }
}
