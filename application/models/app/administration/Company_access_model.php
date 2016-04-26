<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company_access_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array('MD5(concat("CA_FK_User_id","CA_FK_Location_id")) as id',
                    '"a"."U_User_id" as "User_id"',
                    '"b"."LOC_Name" as "Location"',
                    '(CASE WHEN "CA_Active" = ' . "'1'" . ' THEN ' . "'Active'" . ' WHEN "CA_Active" = ' . "'0'" . ' THEN ' . "'Inactive'" . ' END) as "CA_Active"'))
                ->join('tblCOM_User as a', 'a.U_User_id = tblCOM_CompanyAccess.CA_FK_User_id', 'left')
                ->join('tblINV_Location b', 'b.LOC_Id = tblCOM_CompanyAccess.CA_FK_Location_id', 'left')
                ->limit($perPage, $offset)
                ->group_by("CA_FK_User_id,CA_FK_Location_id,a.U_User_id,b.LOC_Id");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("b"."LOC_Name" as text)) LIKE'                                                                                                 => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("a"."U_User_id" as text)) LIKE'                                                                                                => '%' . strtolower($queries['search']) . '%',
                'LOWER(CASE WHEN "CA_Active" = ' . "'1'" . ' THEN ' . "'Active'" . ' WHEN "CA_Active" = ' . "'0'" . ' THEN ' . "'Inactive'" . ' END) LIKE' => '%' . strtolower($queries['search']) . '%'
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
            $this->db->order_by("tblCOM_CompanyAccess.DateCreated DESC");
        }


        $count = $this->db->query($this->db->get_compiled_select("tblCOM_CompanyAccess", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());


        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->where(array('CA_Active' => '1'))
                ->get("tblCOM_CompanyAccess");

        return $result->row_array()['count'];
    }

    public function get_all_data() {

        $result = $this->db->select('*')
                ->get("tblCOM_CompanyAccess");

        return array('rows' => $result->num_rows(),
            'data' => $result->result_array());
    }

    public function get_spec_data($where) {

        $result = $this->db->select('*')
                ->where($where)
                ->get("tblCOM_CompanyAccess");

        return $result->row_array();
    }

    public function get_spec_location_array($where) {

        $result = $this->db->select(array('CA_FK_Location_id', 'SP_StoreID', 'SP_StoreName', 'COM_Name', 'COM_Id', 'CPC_Id', 'CPC_Desc'))
                ->join('tblINV_StoreProfile', 'tblINV_StoreProfile.SP_StoreID = tblCOM_CompanyAccess.CA_FK_Location_id', 'left')
                ->join('tblCOM_Company', 'tblCOM_Company.COM_Id = tblINV_StoreProfile.SP_FK_CompanyID', 'left')
                ->join('tblCOM_CPCenter', 'tblCOM_CPCenter.CPC_Id = tblINV_StoreProfile.SP_FK_CPC_id', 'left')
                ->where($where)
                ->get("tblCOM_CompanyAccess");
        return $result->result_array();
    }

    public function get_all_location_array() {

        $result = $this->db->select(array('CA_FK_Location_id', 'SP_StoreID', 'SP_StoreName', 'COM_Name', 'COM_Id', 'CPC_Id', 'CPC_Desc'))
                ->join('tblINV_StoreProfile', 'tblINV_StoreProfile.SP_StoreID = tblCOM_CompanyAccess.CA_FK_Location_id', 'left')
                ->join('tblCOM_Company', 'tblCOM_Company.COM_Id = tblINV_StoreProfile.SP_FK_CompanyID', 'left')
                ->join('tblCOM_CPCenter', 'tblCOM_CPCenter.CPC_Id = tblINV_StoreProfile.SP_FK_CPC_id', 'left')
                ->get("tblCOM_CompanyAccess");
        return $result->result_array();
    }

    public function get_default_location($where) {

        $result = $this->db->select(array('*', 'CA_FK_Location_id'))
                ->join('tblINV_StoreProfile', 'SP_StoreID = CA_FK_Location_id', 'left')
                ->where($where)
                ->where(array('CA_DefaultLocation' => '1'))
                ->get("tblCOM_CompanyAccess");

        return $result->row_array();
    }

    public function add_data($data) {

        $this->db->insert('tblCOM_CompanyAccess', add_data($data));

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_data($where, $data) {

        $this->db->where($where)
                ->update('tblCOM_CompanyAccess', update_data($data));

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete($where) {

        $this->db->where($where)
                ->delete('tblCOM_CompanyAccess');

        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}
