<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_record_lock_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }


  public function record_lock($pk,$table){

        if($this->check_if_locked($pk,$table)){
          exit('Record Locked');
        }

        if($this->check_if_self_created($pk,$table)){
          return 1;
        }else{
          
        $data = array("UR_PrimaryKey"   => $pk,
                      "UR_TableName"    => $table,
                      "UR_FK_User_id"   => $this->session->userdata('U_User_id'),
                      "UR_DateTimeLock" => date("Y-m-d H:i:s",time()) 
                      );

    		$this->db->insert("tblCOM_UserRecordLock",$data);

      		if($this->db->affected_rows() > 0){
      			return 1;
      		}else{
      			return 0;
      		}

        }
  }	

  public function record_unlock($pk,$table){

      $data = array("UR_PrimaryKey"   => $pk,
                    "UR_TableName"    => $table,
                    "UR_FK_User_id"   => $this->session->userdata('U_User_id')
                  );

  		$this->db->where($data)
  				     ->delete("tblCOM_UserRecordLock");

  		if($this->db->affected_rows() > 0){
  			return 1;
  		}else{
  			return 0;
  		}
  }

  public function check_if_locked($pk,$table){

      $data = array("UR_PrimaryKey"       => $pk,
                    "UR_TableName"        => $table,
                    "UR_FK_User_id !="    => $this->session->userdata('U_User_id')
                  );

  		$result = $this->db->where($data)
  				 		           ->get("tblCOM_UserRecordLock");

  		if($result->num_rows() > 0){
  			return 1;
  		}else{
			  return 0;
  		}
  }

  public function check_if_self_created($pk,$table){

      $data = array("UR_PrimaryKey"    => $pk,
                    "UR_TableName"     => $table,
                    "UR_FK_User_id"    => $this->session->userdata('U_User_id')
                  );

      $result = $this->db->where($data)
                         ->get("tblCOM_UserRecordLock");

      if($result->num_rows() > 0){
        return 1;
      }else{
        return 0;
      }
  }

   public function delete(){

      $data = array(
                    "UR_FK_User_id"    => $this->session->userdata('U_User_id')
                   );

      $result = $this->db->where($data)
                         ->delete("tblCOM_UserRecordLock");

      if($this->db->affected_rows() > 0){
        return 1;
      }else{
        return 0;
      }
  }

}
