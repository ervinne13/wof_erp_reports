<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
    function is_logged_in()
    {
    	$CI   =& get_instance(); 
  		$data = @$CI->session->userdata('U_User_id');
	    if (!empty($data)) { 
	       return array('status' => 1,'data' => $data);
	    }else { 
	       return array('status' => 0); 
	    }
    }   
}