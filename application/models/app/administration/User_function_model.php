<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_function_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

  public function get_spec_data($where){

		$result =	$this->db->select('*')
               ->join("tblCOM_Function","tblCOM_Function.F_Function_id = tblCOM_UserFunction.UF_FK_Function_id")
               ->where($where)
	 						 ->order_by("F_Order_id ASC")
	 						 ->get("tblCOM_UserFunction");
	    return $result->result_array();
  }

  public function delete_spec($where){

    $this->db->where($where)
             ->delete('tblCOM_UserFunction');

    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }

  }

  public function add_data($data){
    $this->db->insert('tblCOM_UserFunction',add_data($data));

    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }
  }


  // public function get_module_function_per_pos($where,$where_in=false){

   
  //     $this->db->select('*')
  //              ->join('tblCOM_Function','tblCOM_Function.F_Function_id = tblCOM_UserFunction.UF_FK_Function_id','left')
  //              ->where($where)
  //              ->order_by('F_Order_id ASC');

  //     if($where_in){
  //         list($key,$value) = $where_in;
  //         $this->db->where_in($key,$value);
  //     }

  //     $result =  $this->db->get("tblCOM_UserFunction");

  //     return $result->result_array();
  // }

  public function get_module_function_per_pos_inside($where){

   
      $this->db->select('*')
               ->join('tblCOM_Function','tblCOM_Function.F_Function_id = tblCOM_UserFunction.UF_FK_Function_id','left')
               ->where($where)
               ->where(array('UF_FK_User_id'=>$this->session->userdata('U_User_id')))
               ->where(array('F_Inside'=>'1'))
               ->order_by('F_Order_id ASC');

      $result =  $this->db->get("tblCOM_UserFunction");

      return $result->result_array();
  }

  public function get_module_function_per_pos_outside($where){

   
      $this->db->select('*')
               ->join('tblCOM_Function','tblCOM_Function.F_Function_id = tblCOM_UserFunction.UF_FK_Function_id','left')
               ->where($where)
               ->where(array('UF_FK_User_id'=>$this->session->userdata('U_User_id')))
               ->where(array('F_Outside'=>'1'))
               ->order_by('F_Order_id ASC');

      $result =  $this->db->get("tblCOM_UserFunction");

      
      return $result->result_array();
  }

}
