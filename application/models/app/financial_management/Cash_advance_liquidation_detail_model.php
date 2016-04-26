<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cash_advance_liquidation_detail_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblCOM_CALiquidation");
    }

    public function get_details($id) {

        $where  = array('md5("CAL_CA_DocNo")' => $id);
        $fields = array(
            'CAL_LiquidationDate',
            'CAL_InvOR',
            'CAL_Payee',
            'CAL_Address',
            'CAL_TinNo',
            'CAL_withVAT',
            'CAL_Particular',
            'CAL_Amount',
            'CAL_VAT',
            'CAL_NetOfVAT',
            'CAL_ChargeTo',
            'CAL_Remarks',
        );

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function get_liquidation_amount($id) {
        $where  = array('md5("CAL_CA_DocNo")' => $id);
        $fields = array(
            'SUM("CAL_Amount") AS liquidated_amount'
        );

        $result = $this->get_spec_data_row_spec_fields($fields, $where);

        if ($result) {
            return $result["liquidated_amount"];
        } else {
            return 0;
        }
    }

    public function save($ca, $liquidation_details) {

        $where = array('CAL_CA_DocNo' => $ca["CA_DocNo"]);

        try {
            $this->db->trans_begin();

            //  reset details
            $this->db->where($where)->delete('tblCOM_CALiquidation');

            if ($liquidation_details) {
                $this->_store_details($ca, $liquidation_details);
                $calAmount = array_sum(array_column($liquidation_details,'CAL_Amount'));
                $this->db->where(array('CA_DocNo'=>$ca['CA_DocNo']))
                         ->update('tblCOM_CA', array('CA_LiquidationAmount' => $calAmount));
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
        foreach ($details as $value) {
            $empty = array_filter($value);
            if (!empty($empty)) {

                $value['CAL_CA_DocNo'] = $header['CA_DocNo'];
                $value['CAL_withVAT']  = array_key_exists('CAL_withVAT', $value) && $value['CAL_withVAT'] ? '1' : '0';
                $this->db->insert('tblCOM_CALiquidation', add_data($value));
            }
        }
    }

}
