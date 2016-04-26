<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Defective_machine_report_model extends MY_Model {

    protected $header_table = "tblCOM_DMR";
    protected $detail_table = "tblCOM_DMRDetail";
    protected $jo_table     = "tblCOM_JO";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->header_table);
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array(
                    'DMR_DocNo',
                    'to_char("DMR_DocDate", \'mm/dd/yyyy\') as "DMR_DocDate" ',
                    'DMR_Location',
                    'DMR_AssetID',
                    'DMR_ItemDescription',
                    'DMR_NatureOfDefect',
                    'DMR_Technician',
                    'DMR_DateDown',
                    'DMR_DateOperational',
                    'DMR_DowntimeDays',
                    'MD5("DMR_DocNo") AS id'))
                ->order_by("DateCreated DESC")
                ->group_by($this->header_table . ".DMR_DocNo");


        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("DMR_DocDate") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("DMR_DocDate") <=' => $queries['date-to']));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("DMR_DocNo" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_DocDate" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_Location" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_AssetID" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_NatureOfDefect" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_Technician" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_DateDown" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_DateOperational" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_DowntimeDays" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMR_Status" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get($this->header_table);

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $result->num_rows(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function update($header, $details) {

        $status = 0;

        $header_where  = array('DMR_DocNo' => $header["DMR_DocNo"]);
        $details_where = array('DMRD_DMR_DocNo' => $header["DMR_DocNo"]);

        try {
            $this->db->trans_begin();

            //  update header
            $this->db->where($header_where)->update($this->header_table, $header);
            //  reset details
            $this->db->where($details_where)->delete($this->detail_table);

            if ($details) {
                $this->_store_details($header, $details);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $status = 1;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
        }

        return $status;
    }

    private function _store_details($header, $details) {
        foreach ($details as $detail) {
            $empty = !array_filter($detail);
            if (!empty($detail) && !$empty) {
                $detail['DMRD_DMR_DocNo'] = $header['DMR_DocNo'];
                unset($detail["id"]);
                unset($detail["DMRD_LineNo"]);

                $this->db->insert($this->detail_table, add_data($detail));
            }
        }
    }

    public function convertToJO($dmr) {

        $status = 0;

        $jo = array(
            "JO_DocDate"        => date("Y-m-d"),
            "JO_RefNo"          => $dmr["DMR_DocNo"],
            "JO_Remarks"        => $dmr["DMR_Remarks"],
            "JO_Location"       => $dmr["DMR_Location"],
            "JO_Company"        => $dmr["DMR_Company"],
            "JO_AssetID"        => $dmr["DMR_AssetID"],
            "JO_NatureOfDefect" => $dmr["DMR_NatureOfDefect"],
            "JO_JobNeeded"      => $dmr["DMR_JobNeeded"],
            "JO_DateDown"       => $dmr["DMR_DateDown"]
        );

        $jo_condition = array(
            "JO_RefNo" => $dmr["DMR_DocNo"]
        );

        $dmr_condition = array(
            "DMR_DocNo" => $dmr["DMR_DocNo"]
        );

        try {
            $this->db->trans_begin();

            //  create JO             
            $this->db->insert($this->jo_table, add_data($jo));

            $find_jo_query = $this->db->select('*')->where($jo_condition);
            $created_jo    = $find_jo_query->row_array();

            if ($created_jo) {

                $dmr_updates = array(
                    "DMR_RefNo"  => $created_jo["JO_DocNo"],
                    "DMR_Status" => "with JO"
                );

                $this->db->where($dmr_condition)->update($this->table, update_data($dmr_updates));

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    $status = 1;
                }
            } else {
                $this->db->trans_rollback();
                $status = 0;
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
        }

        return $status;
    }

}
