<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_access_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

  public function get_spec_no_view($id){

	return    	$this->db->select(array("UP_FK_Access_id"))
						 ->join('tblCOM_UserProfile','tblCOM_UserProfile.UP_FK_Access_id = tblCOM_UserAccess.UA_Access_id','left')
						 ->where(array('md5("UP_FK_User_id"::text)' => $id,
							     			'UA_AccessName !='		=> 'View'))
						 ->get("tblCOM_UserAccess")->result_array();
  }

  public function get_spec_with_view($id){

	return    	$this->db->select(array("UP_FK_Access_id"))
						 ->join('tblCOM_UserProfile','tblCOM_UserProfile.UP_FK_Access_id = tblCOM_UserAccess.UA_Access_id','left')
						 ->where(array('md5("UP_FK_User_id"::text)' => $id,
							     			'UA_AccessName ='		=> 'View'))
						 ->get("tblCOM_UserAccess")->result_array();
  }

}
