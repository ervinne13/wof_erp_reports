<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Module_abstract
 *
 * @author Michelle De Mesa
 */

abstract class Module_abstract extends CI_Controller {

    const LinkDispenseRedemcontr = 'app\sales-operation\dispensed-redemption-tickets';
    const LinkDispenseRedemModel = 'app/sales_operation/Dispensed_redemption_tickets_model';
    const LinkPDItems = 'app/sales_operation/Dispensed_pditems_model';

    public function __construct() 
    {
        parent::__construct();
    }


// //UPDATE TABLE WITH FILTER CONNECTED TO HELPER STATIC DATA HELPER
//     public function update_data($where,$data)
//     {

//        return $this->db->where($where)
//              ->update($this->table,update_data($data)); 

//     }
// //UPDATE TABLE WITH FILTER CONNECTED TO HELPER STATIC DATA HELPER


}
