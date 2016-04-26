<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Revolving_fund_charge_to_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_RFVDChargeTo");
    }

}
