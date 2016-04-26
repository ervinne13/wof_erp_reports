<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('check_attribute')) {
    function check_access($module,$access) {
       $CI =& get_instance();
        
        $CI->db->select('*')
               ->join('tblCOM_UserAccess','tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id','left')
               ->where(array('UP_FK_User_id'  => $CI->session->userdata('U_User_id'),
                             'UP_FK_Module_id'    => $module,
                             'UA_AccessName'      => $access));

      $result =  $CI->db->get("tblCOM_UserProfile");
      
      return $result->num_rows() > 0;
    }
}
