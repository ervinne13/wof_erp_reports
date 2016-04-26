<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cash_advance_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_CA");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array(
                    'to_char("CA_DocDate", \'mm/dd/yyyy\') as "CA_DocDate" ',
                    'CA_DocNo',
                    'CONCAT(to_char("CA_DateFrom", \'mm/dd/yyyy\'), \' To \', to_char("CA_DateTo", \'mm/dd/yyyy\')) as "CA_DateNeeded"',
                    'CA_EmployeeName',
                    'CA_Company',
                    'CA_Location',
                    'CA_Amount',
                    'CA_Purpose',
                    'CA_RequestStatus',
                    'MD5("CA_DocNo") AS id'))
                ->order_by("DateCreated DESC")
                ->group_by("tblCOM_CA.CA_DocNo");


        if(isset($queries['date-from'])){
            $this->db->where(array('DATE("CA_DocDate") >=' => $queries['date-from']));
        }

        if(isset($queries['date-to'])){
            $this->db->where(array('DATE("CA_DocDate") <=' => $queries['date-to']));
        }
                

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("CA_DocDate" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_DocNo" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_DateFrom" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_DateTo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_EmployeeName" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_Company" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_Location" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_Amount" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_Purpose" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CA_RequestStatus" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblCOM_CA");

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

        $header_where  = array('CA_DocNo' => $header["CA_DocNo"]);
        $details_where = array('CAD_CA_DocNo' => $header["CA_DocNo"]);

        try {
            $this->db->trans_begin();

            //  Auto generated only on create
            unset($header["CA_Amount"]);
            unset($header["CA_DocDate"]);

            $header["CA_SupplierID"] = $this->session->userdata('U_SupplierID');

            //  update header
            $this->db->where($header_where)->update('tblCOM_CA', $header);
//            $updated_header_query = $this->db->where($header_where)->select('*')->get('tblCOM_Reimbursement');
//            $updated_header       = $updated_header_query->row_array();
            //  reset details
            $this->db->where($details_where)->delete('tblCOM_CADetail');

            if ($details) {
                $amount = $this->_store_details($header, $details);

                //  update reimbursement amount
                $header_updates = array(
                    'CA_Amount' => $amount
                );
                $this->db->where($header_where)->update('tblCOM_CA', $header_updates);
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
        $total_amount = 0;
        foreach ($details as $value) {
            $empty = !array_filter($value);
            if (!empty($value) && !$empty) {
                $value['CAD_CA_DocNo'] = $header['CA_DocNo'];

                $total_amount += $value["CAD_Total"];

                $this->db->insert('tblCOM_CADetail', add_data($value));
            }
        }

        return $total_amount;
    }

}
