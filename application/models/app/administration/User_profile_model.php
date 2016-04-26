<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_profile_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_UserProfile");
    }

  public function delete_spec($where){

		$this->db->where($where)
             ->delete('tblCOM_UserProfile');

    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }

  }

  public function get_module_access_per_pos_inline_outside($where){

    $result = $this->db->select('*')
               ->join('tblCOM_UserAccess','tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id','left')
               ->where($where)
               ->where(array('UP_FK_User_id'=>$this->session->userdata('U_User_id')))
               ->where(array("UA_Inline" => '1',"UA_Outside" => '1'))
               ->get("tblCOM_UserProfile");

      return $result->result_array();
  }

  public function get_module_access_per_pos_inline_inside($where){

    $result = $this->db->select('*')
               ->join('tblCOM_UserAccess','tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id','left')
               ->where($where)
               ->where(array('UP_FK_User_id'=>$this->session->userdata('U_User_id')))
               ->where(array("UA_Inline" => '1',"UA_Inside" => '1'))
               ->get("tblCOM_UserProfile");
      
      return $result->result_array();
  }

   public function get_module_access_per_pos_header_inside($where){

    $result = $this->db->select('*')
               ->join('tblCOM_UserAccess','tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id','left')
               ->where($where)
               ->where(array('UP_FK_User_id'=>$this->session->userdata('U_User_id')))
               ->where(array("UA_Header" => '1',"UA_Inside" => '1'))
               ->get("tblCOM_UserProfile");
      
      return $result->result_array();
  }

   public function get_module_access_per_pos_header_outside($where){

    $result = $this->db->select('*')
               ->join('tblCOM_UserAccess','tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id','left')
               ->where($where)
               ->where(array('UP_FK_User_id'=>$this->session->userdata('U_User_id')))
               ->where(array("UA_Header" => '1',"UA_Outside" => '1'))
               ->get("tblCOM_UserProfile");
  
      return $result->result_array();
  }

}
