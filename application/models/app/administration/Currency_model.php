<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Company_currency_model
 *
 * @author Ervinne Sodusta
 */
class Currency_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblACC_ExchangeRate");
    }

    public function convert_amount($company_id, $convert_to_currency_id, $amount) {

        $this->db->select(array(
            '((' . $amount . ' / "ER_BaseCurrencyRate") * "ER_ConvCurrencyRate")::NUMERIC(12,2) AS "converted_amount"',
            'ER_FK_BaseCurrency_id',
            'ER_BaseCurrencyRate',
            'ER_ConvCurrencyRate',
            'ER_DocumentDate'
        ));
        $this->db->from('"tblACC_ExchangeRate er');
        $this->db->join('"tblCOM_Company c"', 'er.ER_FK_BaseCurrency_id = c.COM_Currency', 'left');
        $this->db->where('COM_Id', $company_id);
        $this->db->where('ER_FK_ConvCurrency_id', $convert_to_currency_id);
        $this->db->order_by('ER_DocumentDate DESC');

        $query = $this->db->get();
        
        return $query->row_array();
    }

    public function get_company_base_currency_id($company_id) {
        $this->db->select(array(
            'COM_Currency'
        ));
        $this->db->from('"tblCOM_Company');
        $this->db->where('COM_Id', $company_id);

        $query = $this->db->get();

        return $query->row_array();
    }

}
