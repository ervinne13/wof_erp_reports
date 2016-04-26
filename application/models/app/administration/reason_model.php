<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reason_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_Reason");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("*",
                    'md5("R_Id") as id',
                    '(CASE WHEN "R_Active" = ' . "'1'" . ' THEN ' . "'Active'" . ' WHEN "R_Active" = ' . "'0'" . ' THEN ' . "'Inactive'" . ' END) as "R_Active"'))
                ->group_by("R_Id");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("R_Id" as text)) LIKE'                                                                                                       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("R_Description" as text)) LIKE'                                                                                              => '%' . strtolower($queries['search']) . '%',
                'LOWER(CASE WHEN "R_Active" = ' . "'1'" . ' THEN ' . "'Active'" . ' WHEN "R_Active" = ' . "'0'" . ' THEN ' . "'Inactive'" . ' END) LIKE' => '%' . strtolower($queries['search']) . '%'
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
            $this->db->order_by("tblCOM_Reason.R_Id ASC");
        }


        $count = $this->db->query($this->db->get_compiled_select("tblCOM_Reason", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());


        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count("tblCOM_Reason"),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function getReasonsPerModule($module_id) {

        $this->db->select(array("RM_FK_Reason_id", "R_Description"));
        $this->db->join('"tblCOM_Reason"', 'R_Id = RM_FK_Reason_id', 'inner');
        $this->db->where(array(
            '"RM_FK_Module_id"' => $module_id
        ));

        $query = $this->db->get('"tblCOM_ReasonModule"');

        return $query->result_array();
    }

    public function get_spec_reason_array_per_module($where) {
        $result = $this->db->select('*')
                ->join('tblCOM_ReasonModule', 'tblCOM_ReasonModule.RM_FK_Reason_id = tblCOM_Reason.R_Id', 'left')
                ->where($where)
                ->where(array('R_Active' => '1'))
                ->get("tblCOM_Reason");

        return array('rows' => $result->num_rows(),
            'data' => $result->result_array());
    }

    public function add_data($data) {

        $rm = $data['RM_FK_Module_id'];
        unset($data['RM_FK_Module_id']);

        $this->db->trans_start();
        $this->db->insert('tblCOM_Reason', add_data($data));
        foreach ($rm as $key => $value) {
            $this->db->insert('tblCOM_ReasonModule', array('RM_FK_Module_id' => $value, 'RM_FK_Reason_id' => $data['R_Id']));
        }
        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_main_data($where, $data) {

        $this->db->trans_start();

        $this->db->where($where)
                ->update('tblCOM_Reason', update_data($data['reason']));

        foreach ($data['delete'] as $key => $value) {
            $this->db->where(array('md5("RM_FK_Reason_id")' => $where['md5("R_Id")']))
                    ->where(array('RM_FK_Module_id' => $value))
                    ->delete("tblCOM_ReasonModule");
        }

        foreach ($data['add'] as $key => $value) {
            $this->db->insert("tblCOM_ReasonModule", array('RM_FK_Module_id' => $value, 'RM_FK_Reason_id' => $data['reason']['R_Id']));
        }

        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}
