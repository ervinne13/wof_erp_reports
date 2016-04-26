<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('update_data'))
{
    function update_data($param=array())
    {	

    	$CI   =& get_instance(); 
  		$data = $CI->session->userdata('U_User_id');
    	return array_merge($param,array('ModifiedBy' =>$data,'DateModified' => date("Y-m-d H:i:s",time())));
    }   
}
if ( ! function_exists('add_data'))
{
    function add_data($param=array())
    {	

    	$CI   =& get_instance(); 
  		$data = $CI->session->userdata('U_User_id');
    	return array_merge($param,array('CreatedBy' =>$data,'DateCreated' => date("Y-m-d H:i:s",time()),'ModifiedBy' =>$data,'DateModified' => date("Y-m-d H:i:s",time())));
    }   
}
