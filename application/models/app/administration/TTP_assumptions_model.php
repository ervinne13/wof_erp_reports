<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TTP_assumptions_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_TTPAssumptions");
    }

    public function find($location, $type) {
        $where = array(
            'TTP_SP_StoreID' => $location,
            'TTP_Type'       => "'" . $type . "'"
        );

        return $this->get_spec_data_row($where);
    }

}
