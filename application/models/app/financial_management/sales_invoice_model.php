<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_invoice_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_SalesInvoice");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("SI_DocNo",
                    "SI_DocNo",
                    "SI_DocDate",
                    "SI_CustomerID",
                    "SI_CustomerName",
                    "SI_DueDate",
                    "SI_Amount",
                    "SI_Location",
                    "SI_Status",
                    "SI_Company",
                    'md5("SI_DocNo") AS id'))
                ->limit($perPage, $offset)
                ->order_by("DateCreated DESC")
                ->group_by("SI_DocNo");

        if (isset($queries['search'])) {
            $this->db->group_start();
            $this->db->where(array('LOWER(CAST("SI_DocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_DocDate" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_CustomerID" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_CustomerName" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_DueDate" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_Amount" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_Location" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("SI_Status" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%'));
            $this->db->group_end();
        }

        if (isset($queries['date-to']) && isset($queries['date-from'])) {
            $this->db->where("SI_DocDate < '{$queries['date-to']}' AND SI_DocDate >= '{$queries['date-from']}'");
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblINV_SalesInvoice");

        if ($result->num_rows() > 0) {
            return array('rows' => $result->num_rows(),
                'data' => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function get_all_data() {

        return array('rows' => $this->db->select('*')
                    ->get("tblINV_SalesInvoice")->num_rows(),
            'data' => $this->db->select('*')
                    ->get("tblINV_SalesInvoice")->result_array());
    }

    public function get_gl_account_customer_info($customer_id) {

        $this->db->select(array("cpg.CPG_Code", "cpg.CPG_COA_FK_AccountNo"));
        $this->db->from("tblACC_CustomerPostingGroup cpg");
        $this->db->join("tblACC_Customer c", "c.C_CustomerPostingGroup = cpg.CPG_Code");
        $this->db->where(array("c.C_Id" => $customer_id));

        $results = $this->db->get();

        if (!$results) {
            throw new Exception("Customer not found");
        }

        $customer = $results->row_array();

        if (!$customer) {
            throw new Exception("Customer not found");
        }

        return array(
            "GL_AccountID"   => $customer["CPG_COA_FK_AccountNo"],
            "GL_AccountName" => $customer["CPG_Code"]
        );
    }

    public function get_gl_account_vat_info($customer_id, $vppg) {

        $this->db->select(array("VPS_COA_FK_SalesAccountNo", "COA_AccountName"));
        $this->db->from("tblACC_VATPostingSetup vps");
        $this->db->join("tblACC_Customer c", "c.C_VATPostingGroup = vps.VPS_VBPG_FK_Code");
        $this->db->join("tblACC_ChartAccount coa", "vps.VPS_COA_FK_SalesAccountNo = coa.COA_Account_id");
        $this->db->where("c.C_Id", $customer_id);
        $this->db->where("vps.VPS_VPPG_FK_Code", $vppg);

        $results = $this->db->get();

        if (!$results) {
            throw new Exception("VAT (customer id: {$customer_id} and vat: {$vppg}) not found");
        }

        $vat = $results->row_array();

        if (!$vat) {
            throw new Exception("VAT (customer id: {$customer_id} and vat: {$vppg}) not found");
        }

        return array(
            "GL_AccountID"   => $vat["VPS_COA_FK_SalesAccountNo"],
            "GL_AccountName" => $vat["COA_AccountName"]
        );
    }

    public function get_gl_account_wht_info($customer_id, $wht_code) {

        $this->db->select(array("WPS_COA_FK_WHTRecAccountNo", "COA_AccountName"));
        $this->db->from("tblACC_WHTPostingGroupSetup wpgs");
        $this->db->join("tblACC_Customer c", "wpgs.WPS_WBPG_FK_Code = c.C_WHTPostingGroup");
        $this->db->join("tblACC_ChartAccount coa", "wpgs.WPS_COA_FK_WHTRecAccountNo = coa.COA_Account_id");
        $this->db->where("c.C_Id", $customer_id);
        $this->db->where("WPS_WPPG_FK_Code", $wht_code);

        $results = $this->db->get();

        if (!$results) {
            throw new Exception("WHT (customer id: {$customer_id} and wht: {$wht_code}) not found");
        }

        $wht = $results->row_array();

        if (!$wht) {
            throw new Exception("WHT (customer id: {$customer_id} and wht: {$wht_code}) not found");
        }

        return array(
            "GL_AccountID"   => $wht["WPS_COA_FK_WHTRecAccountNo"],
            "GL_AccountName" => $wht["COA_AccountName"]
        );
    }


     public function update($header, $details) {

        $status = 0;

        $header_where  = array('SI_DocNo' => $header["SI_DocNo"]);
        $details_where = array('SID_PFK_DocNo' => $header["SI_DocNo"]);

        try {
            $this->db->trans_begin();

            //  Auto generated only on create
            // unset($header["CA_Amount"]);
            // unset($header["CA_DocDate"]);

            // $header["CA_SupplierID"] = $this->session->userdata('U_SupplierID');

            //  update header
            $this->db->where($header_where)->update('tblINV_SalesInvoice', $header);
//            $updated_header_query = $this->db->where($header_where)->select('*')->get('tblCOM_Reimbursement');
//            $updated_header       = $updated_header_query->row_array();
            //  reset details
            $this->db->where($details_where)->delete('tblINV_SalesInvoiceDetail');

            if ($details) {
                $amount = $this->_store_details($header, $details);

                //  update reimbursement amount
                // $header_updates = array(
                //     'CA_Amount' => $amount
                // );
                $this->db->where($header_where)->update('tblINV_SalesInvoice');
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
                $value['SID_PFK_DocNo'] = $header['SI_DocNo'];

                // $total_amount += $value["CAD_Total"];

                $this->db->insert('tblINV_SalesInvoiceDetail', add_data($value));
            }
        }

        // return $total_amount;
    }


}
