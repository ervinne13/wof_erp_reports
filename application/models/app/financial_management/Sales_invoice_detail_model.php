<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_invoice_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_SalesInvoiceDetail");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("*",'"AD_Desc" as "UOM"',

                    'MD5(CONCAT("SID_PFK_DocNo","SID_LineNo")) AS id'))
                ->join('tblCOM_AttributeDetail','AD_Id = CAST("SID_UOM" as integer)','left')
                ->where(array('md5("SID_PFK_DocNo")' => $id))
                ->limit($perPage, $offset)
                ->order_by("tblINV_SalesInvoiceDetail.DateCreated DESC")
                ->group_by("tblINV_SalesInvoiceDetail.SID_PFK_DocNo,SID_LineNo,AD_FK_Code,AD_Code");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("SID_ItemTypeID" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_Location" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_SubLocation" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("AD_Code" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_UnitPrice" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_Amount" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_RefFrom" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_RefTo" as text)) LIKE'           => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_CostCenter" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_Comment" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_VAT" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_WHT" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("SID_BaseUOM" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblINV_SalesInvoiceDetail");
        
        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => 2,
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }


    public function get_details($id) {

        $where  = array('md5("SID_PFK_DocNo")' => $id);
        $fields = array(
            'SID_ItemTypeID',
            'SID_ItemNo',
            'SID_ItemDescription',
            'SID_Location',
            'SID_Qty',
            'SID_UOM',
            'SID_UnitPrice',
            'SID_Amount',
            'SID_CostCenter',
            'SID_Comment',
            'SID_VAT',
            'SID_WHT',
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function compute_vat_amount($header, $detail) {

        $this->db->select("VPS_Vat");
        $this->db->from("tblACC_VATPostingSetup vps");
        $this->db->join("tblACC_Customer c", "vps.VPS_VBPG_FK_Code = c.C_VATPostingGroup");
        $this->db->where("vps.VPS_VPPG_FK_Code", $detail["SID_VAT"]);
        $this->db->where("c.C_Id", $header["SI_CustomerID"]);

        $vat_data_result = $this->db->get();
        $vat_data        = $vat_data_result->row_array();
        $vat             = $vat_data["VPS_Vat"];

        if (!$vat) {
            $vat = 0;
        }

        return ($detail["SID_Amount"] / 1.12) * ($vat / 100);
    }

    public function compute_wht_amount($detail) {

        $this->db->select("WPS_WHT");
        $this->db->from("tblACC_WHTPostingGroupSetup wps");
        $this->db->join("tblACC_Customer c", "wps.WPS_WBPG_FK_Code = c.C_WHTPostingGroup");
        $this->db->where("WPS_WPPG_FK_Code", $detail["SID_WHT"]);

        $wht_data_result = $this->db->get();
        $wht_data        = $wht_data_result->row_array();
        $wht             = $wht_data["WPS_WHT"];

        if (!$wht) {
            $wht = 0;
        }

        return ($detail["SID_Amount"] / 1.12) * ($wht / 100);
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->get("tblINV_SalesInvoiceDetail");
        return $result->row_array()['count'];
    }

}
