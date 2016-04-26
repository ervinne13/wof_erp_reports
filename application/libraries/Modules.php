<?php if ( ! defined('BASEPATH')) exit('No direct script Access allowed'); 

class Modules
{
  public function get_modules()
  { 

        $CI =& get_instance();
        
          $CI->db->select(array("M_Module_id","M_Module_id as mod","M_Parent","M_Description","M_Trigger"));
          $CI->db->join("tblCOM_UserAccess","tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id","left");
          $CI->db->join("tblCOM_Module","tblCOM_Module.M_Module_id = tblCOM_UserProfile.UP_FK_Module_id","left");
          $CI->db->where("M_Level", 1);
          $CI->db->where("UP_FK_User_id", $CI->session->userdata('U_User_id'));
          $CI->db->where("UA_AccessName", 'View');
          $CI->db->order_by('M_Module_id ASC');
          $result =    $CI->db->get("tblCOM_UserProfile")->result_array();
        foreach ($result as $key => $value) {
                  $result[$key]['next'] = $this->_module_recursive($value['M_Module_id']);
                }

        if($result){
           return $this->_sub_menu($result);
        }else{
           return FALSE;
        }
  }

  public function get_sub_modules($module)
  { 

        $CI =& get_instance();

          $CI->db->select(array("M_Module_id",'md5("M_Module_id":: text) as mod',"M_Parent","M_Description","M_Trigger"));
          $CI->db->join("tblCOM_UserAccess","tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id","left");
          $CI->db->join("tblCOM_Module","tblCOM_Module.M_Module_id = tblCOM_UserProfile.UP_FK_Module_id","left");
          $CI->db->where("M_Parent", $module);
          $CI->db->where("UA_AccessName", 'View');
          $CI->db->where("UP_FK_User_id", $CI->session->all_userdata()['U_User_id']);
          $CI->db->order_by('M_Module_id ASC');
          $result =    $CI->db->get("tblCOM_UserProfile")->result_array();
        foreach ($result as $key => $value) {
                  $result[$key]['next'] = $this->_module_recursive($value['M_Module_id']);
                }

        if($result){
           return $this->_sub_menu($result);
        }else{
           return FALSE;
        }
  }
  public function get_all_modules(){
      $CI =& get_instance();
        
          $CI->db->select(array("M_Module_id","M_Parent","M_Description","M_Trigger"));
          $CI->db->where("M_Level", 1);
          $CI->db->order_by('M_Module_id ASC');
          $result =    $CI->db->get("tblCOM_Module")->result_array();
        foreach ($result as $key => $value) {
                  $result[$key]['view'] = $this->_get_module_view($value['M_Module_id']);
                  $result[$key]['function'] = $this->_get_function($value['M_Module_id']);
                  $result[$key]['Access']   = $this->_get_Access($value['M_Module_id']);
                  $result[$key]['next'] = $this->_module_all_recursive($value['M_Module_id']);
                }

        if($result){
           return $result;
        }else{
           return FALSE;
        }
  }

  private function _get_function($module){
      $CI =& get_instance();
          $CI->db->select(array("F_FunctionName","F_Function_id"));
          $CI->db->where("F_FK_Module_id", $module);
          $CI->db->order_by('F_Function_id ASC');
          $result =    $CI->db->get("tblCOM_Function")->result_array();
        if($result){
           return $result;
        }else{
           return FALSE;
        }
  }

  private function _get_Access($module){
      $CI =& get_instance();
        
          $CI->db->select(array("UA_AccessName","UA_Access_id"));
          $CI->db->where("UA_FK_Module_id", $module);
          $CI->db->where("UA_AccessName !=", 'View');
          $CI->db->order_by('UA_Access_id ASC');
          $result =    $CI->db->get("tblCOM_UserAccess")->result_array();
        if($result){
           return $result;
        }else{
           return FALSE;
        }
  }

  private function _get_module_view($module){
      $CI =& get_instance();
        
          $CI->db->select(array("UA_AccessName","UA_Access_id"));
          $CI->db->where("UA_FK_Module_id", $module);
          $CI->db->where("UA_AccessName =", 'View');
          $CI->db->order_by('UA_Access_id ASC');
          $result =    $CI->db->get("tblCOM_UserAccess")->result_array();
        if($result){
           return $result;
        }else{
           return FALSE;
        }
  }

  private function _module_all_recursive($module){

     $CI =& get_instance();

        $result = $CI->db
                      ->select(array("M_Module_id",'md5("M_Module_id":: text) as mod',"M_Parent","M_Description","M_Trigger"))
                      ->where("M_Parent", $module)
                      ->order_by('M_Module_id ASC')
                      ->get("tblCOM_Module")->result_array();

        foreach ($result as $key => $value) {
          $result[$key]['view']     = $this->_get_module_view($value['M_Module_id']);
          $result[$key]['function'] = $this->_get_function($value['M_Module_id']);
          $result[$key]['Access']   = $this->_get_Access($value['M_Module_id']);
            if($this->_module_all_recursive($value['M_Module_id'])){
                    $result[$key]['next']     = $this->_module_all_recursive($value['M_Module_id']);
            }
        }          
        if($result){
           return $result;
        }else{
           return FALSE;
        }

  }

  private function _module_recursive($module){

     $CI =& get_instance();

          $CI->db->select(array("M_Module_id","M_Parent",'md5("M_Module_id":: text) as mod',"M_Description","M_Trigger"));
          $CI->db->join("tblCOM_UserAccess","tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id","left");
          $CI->db->join("tblCOM_Module","tblCOM_Module.M_Module_id = tblCOM_UserProfile.UP_FK_Module_id","left");
          $CI->db->where("M_Parent", $module);
          $CI->db->where("UA_AccessName", 'View');
          $CI->db->where("UP_FK_User_id", $CI->session->all_userdata()['U_User_id']);
          $CI->db->order_by('M_Sequence ASC');
          $result =    $CI->db->get("tblCOM_UserProfile")->result_array();

        foreach ($result as $key => $value) {
          if($this->_module_recursive($value['M_Module_id'])){

                  $result[$key]['next'] = $this->_module_recursive($value['M_Module_id']);
          }
        }          
        if($result){
           return $result;
        }else{
           return FALSE;
        }

  }
  public function sub_menu_tree($arr=array(),$data) {
       $str="";
       // echo "<pre>";
       // print_r($data);
       // exit();
       if(!empty($arr)){
        foreach ($arr as $val) {
          $view = in_array($val['view'][0]['UA_Access_id'],$data['view']) ? 'checked':'';
          if (!empty($val['next'])) {
                $str.= "<tr data-tt-id='".$val['M_Module_id']."' data-tt-parent-id='".$val['M_Parent']."'><td><label class='mdl-chk'><input type='checkbox' ".$view." data-module='".$val['M_Module_id']."' data-id='".$val['view'][0]['UA_Access_id']."' class='marker'></label><span class='tree-desc'>". $val['M_Description']."</span>";
                $str.= "</td><td>";
                if(!empty($val['Access'])){
                  foreach ($val['Access'] as $Access => $acc) {
                    $acc_check = in_array($acc['UA_Access_id'],$data['aret']) ? 'checked':'';
                    $str.= "<span class='checkbox'><label class='mdl-sp'><input type='checkbox' ".$acc_check." data-id='".$acc['UA_Access_id']."' class='mdl-chk'>".$acc['UA_AccessName']."</label></span>";
                  }
                }
                $str.= "</td><td>";
                if(!empty($val['function'])){
                  foreach ($val['function'] as $function => $func) {
                    $func_check = in_array($func['F_Function_id'],$data['fret']) ? 'checked':'';
                    $str.= "<span class='checkbox'><label class='mdl-sp'><input type='checkbox' ".$func_check." data-id='".$func['F_Function_id']."' class='mdl-chk'>".$func['F_FunctionName']."</label></span>";
                  }
                }
                $str.= "</td></tr>";
                $str.= $this->sub_menu_tree($val['next'],$data);
          
            } else {
                $str.= "<tr data-tt-id='".$val['M_Module_id']."' data-tt-parent-id='".$val['M_Parent']."'><td><label class='mdl-chk'><input type='checkbox' ".$view." data-module='".$val['M_Module_id']."' data-id='".$val['view'][0]['UA_Access_id']."' class='marker'></label><span class='tree-desc'>". $val['M_Description']."</span>";
                $str.= "</td><td>";
                  if(!empty($val['Access'])){
                    foreach ($val['Access'] as $Access => $acc) {
                      $acc_check = in_array($acc['UA_Access_id'],$data['aret']) ? 'checked':'';
                      $str.= "<span class='checkbox'><label class='mdl-sp'><input type='checkbox' ".$acc_check." data-id='".$acc['UA_Access_id']."' class='mdl-chk'>".$acc['UA_AccessName']."</label></span>";
                    }
                  }
                $str.= "</td><td>";
                  if(!empty($val['function'])){
                    foreach ($val['function'] as $function => $func) {
                      $func_check = in_array($func['F_Function_id'],$data['fret']) ? 'checked':'';
                      $str.= "<span class='checkbox'><label class='mdl-sp'><input type='checkbox' ".$func_check." data-id='".$func['F_Function_id']."' class='mdl-chk'>".$func['F_FunctionName']."</label></span>";
                    }
                  }
                $str.= "</td></tr>";
            }
        }
        return $str;
       }
    }
 private function _sub_menu($arr=array(),$indent="sub") {
       $str="";
       $id = uniqid();
       if(!empty($arr)){
        foreach ($arr as $val) {
          if (!empty($val['next'])) {
                $str.= "<li><a href='javascript:void(0)' data-toggle='collapse' data-target='#".md5($id.strtolower(str_replace(' ', '-', $val['M_Module_id'])))."'>" . $val['M_Description']."<span class='glyphicon glyphicon-plus-sign pull-right'></span></a>";
                $str.= "<ul class='nav collapse ".$indent."' id='".md5($id.strtolower(str_replace(' ', '-', $val['M_Module_id'])))."'>";
                $str.= $this->_sub_menu($val['next'],$indent."-sub");
                $str.= "</li>";
                $str.= "</ul>";
            } else {
                $str.= "<li><a href='".base_url()."app/".$val['M_Trigger']."'>" . $val['M_Description'] . "</a></li>";
            }
        }
        return $str;
       }
    }
   
  public function get_module_grouping()
  { 
 
        $CI =& get_instance();
        
          $CI->db->select(array("M_Module_id","M_Description","M_Icon","M_Trigger"));
          $CI->db->join("tblCOM_UserAccess","tblCOM_UserAccess.UA_Access_id = tblCOM_UserProfile.UP_FK_Access_id","left");
          $CI->db->join("tblCOM_Module","tblCOM_Module.M_Module_id = tblCOM_UserAccess.UA_FK_Module_id","left");
          $CI->db->where("M_Level", "1");
          $CI->db->where("UA_AccessName", 'View');
          $CI->db->where("UP_FK_User_id", $CI->session->all_userdata()['U_User_id']);
          $CI->db->order_by('M_Module_id ASC');
          $result =    $CI->db->get("tblCOM_UserProfile")->result_array();
        if($result){
           return $result;
        }else{
           return FALSE;
        }
  }
  
}