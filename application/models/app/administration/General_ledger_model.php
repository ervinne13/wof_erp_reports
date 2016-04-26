<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_ledger_model extends MY_Model {

    protected $table = "tblACC_GLEntry";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->table);
    }

    public function add_data($data) {
        return $this->db->insert($this->table, $data);
    }

}
