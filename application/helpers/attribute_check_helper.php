<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('check_attribute')) {
    function check_attribute($id='0') {
       $CI =& get_instance();
        
        $CI->db->select(array("A_Desc"));
        $CI->db->where("A_FK_Module_id", $id);
        $result =    $CI->db->get("tblCOM_Attribute")->row(0);

        if($result){
           return $result->A_Desc;
        }else{
           redirect(base_url()."error", 'refresh');
        }
    }
}
