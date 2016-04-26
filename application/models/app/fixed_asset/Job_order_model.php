<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_order_model extends MY_Model {

    protected $dmr_header_table = "tblCOM_DMR";
    protected $header_table     = "tblCOM_JO";
    protected $detail_table     = "tblCOM_JODetail";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->header_table);
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array(
                    'JO_DocNo',
                    'to_char("JO_DocDate", \'mm/dd/yyyy\') as "JO_DocDate" ',
                    'JO_Location',
                    'JO_AssetID',
                    'JO_ItemDescription',
                    'JO_NatureOfDefect',
                    'JO_Technician',
                    'JO_DateDown',
                    'JO_DateOperational',
                    'JO_DowntimeDays',
                    'MD5("JO_DocNo") AS id'))
                ->order_by("DateCreated DESC")
                ->group_by($this->header_table . ".JO_DocNo");


        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("JO_DocDate") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("JO_DocDate") <=' => $queries['date-to']));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("JO_DocNo" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_DocDate" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_Location" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_AssetID" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_NatureOfDefect" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_Technician" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_DateDown" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_DateOperational" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_DowntimeDays" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("JO_Status" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%'));
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

        $header_where  = array('JO_DocNo' => $header["JO_DocNo"]);
        $details_where = array('JOD_JO_DocNo' => $header["JO_DocNo"]);

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
                $detail['JOD_JO_DocNo'] = $header['JO_DocNo'];
                unset($detail["id"]);
                unset($detail["JOD_LineNo"]);

                $this->db->insert($this->detail_table, add_data($detail));
            }
        }
    }

    public function convertToJO($dmr_id, $module_id) {

        $find_dmr_query = $this->db->select('*')->where(array('md5("DMR_DocNo")' => $dmr_id))->get($this->dmr_header_table);
        $dmr            = $find_dmr_query->row_array();

        $status = 1;

        $jo = array(
            "JO_DocDate"         => date("Y-m-d"),
            "JO_RefNo"           => $dmr["DMR_DocNo"],
            "JO_Remarks"         => $dmr["DMR_Remarks"],
            "JO_Location"        => $dmr["DMR_Location"],
            "JO_Company"         => $dmr["DMR_Company"],
            "JO_AssetID"         => $dmr["DMR_AssetID"],
            "JO_ItemNo"          => $dmr["DMR_ItemNo"],
            "JO_ItemDescription" => $dmr["DMR_ItemDescription"],
            "JO_Technician"      => $dmr["DMR_Technician"],
            "JO_NatureOfDefect"  => $dmr["DMR_NatureOfDefect"],
            "JO_JobNeeded"       => $dmr["DMR_JobNeeded"],
            "JO_DateDown"        => $dmr["DMR_DateDown"]
        );

        $jo_condition = array(
            "JO_RefNo" => $dmr["DMR_DocNo"]
        );

        $dmr_condition = array(
            "DMR_DocNo" => $dmr["DMR_DocNo"]
        );

        //  check if there is an already existing JO
        $existing_jo_query = $this->db->select('*')->where($jo_condition)->get($this->header_table);
        $existing_jo       = $existing_jo_query->row_array();

        if ($existing_jo) {
            //  update JO
            $result = $this->update_data($jo_condition, $jo);
            if ($result != 1) {
                throw new Exception("Failed to update JO");
            }

            $dmr_updates = array(
                "DMR_RefNo"  => $existing_jo["JO_DocNo"],
                "DMR_Status" => "with JO"
            );
        } else {
            //  create JO
            $jo["JO_Status"] = "Open";
            $this->load->model('app/administration/no_series_model');
            $data            = $this->no_series_model->get_no_series($module_id, $this->header_table, "JO_DocNo", $jo);
            if ($data['rows'] == 0) {
                throw new Exception("Failed to create JO");
            } else if ($data['rows'] == 1) {
                $created_jo_doc_no = $data['data'][0]['NS_Id'] . '-' . $data['data'][0]['nsnum'];
            }

            $dmr_updates = array(
                "DMR_RefNo"  => $created_jo_doc_no,
                "DMR_Status" => "with JO"
            );
        }

        $this->db->where($dmr_condition)->update($this->dmr_header_table, update_data($dmr_updates));

        return $status;
    }

}
