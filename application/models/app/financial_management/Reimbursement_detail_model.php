<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reimbursement_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_ReimbursementDetail");
    }

    public function get_details($id) {

        $where  = array('md5("RED_RE_DocNo")' => $id);
        $fields = array(
            'to_char("RED_TransDate", \'mm/dd/yyyy\') as "RED_TransDate" ',
            'RED_Amount',
            'RED_InvOR',
            'RED_Payee',
            'RED_Address',
            'RED_TinNo',
            'RED_withVAT',
            'RED_Particulars',
            'RED_VAT',
            'RED_NetOfVat',
            'RED_ChargeTo'
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function table_data($data) {

        extract($data);

        $fields = array(
            'to_char("RED_TransDate", \'mm/dd/yyyy\') as "RED_TransDate" ',
            'RED_Amount',
            'RED_InvOR',
            'RED_Payee',
            'RED_Address',
            'RED_TinNo',
            'RED_withVAT',
            'RED_Particulars',
            'RED_VAT',
            'RED_NetOfVat',
            'RED_ChargeTo'
        );

        $this->db
                ->select($fields)
                ->where(array('md5("RED_RE_DocNo")' => $id))
                ->order_by("DateCreated DESC");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("RED_TransDate" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_Amount" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_Payee" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_Address" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_TinNo" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_withVAT" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_withVAT" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_Particulars" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_VAT" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_NetOfVat" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RED_ChargeTo" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblCOM_ReimbursementDetail");

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $result->num_rows(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

}
