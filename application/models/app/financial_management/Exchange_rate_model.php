<?php

/**
 * Description of Exchange_rate_model
 *
 * @author Ervinne Sodusta
 */
class Exchange_rate_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblACC_ExchangeRate");
    }

    public function convert($amount, $base_currency_id, $convert_to_currency_id) {
        
    }
    
}
