<?php
class MY_Form_validation extends CI_Form_validation
{
  function __construct($config = array())
  {
    parent::__construct($config);
  }

  function error_array()
  {
    if (count($this->_error_array) === 0)
      return FALSE;
    else
      return $this->_error_array;
  }
  

  public function is_uniq_attr($str, $field)
  { 
      
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where('AD_Code', $str)
                      ->where('AD_FK_Code', $field)
                      ->limit(1)
                      ->get("tblCOM_AttributeDetail")->num_rows();
                      
        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('is_uniq_attr', 'The %s that you requested is already taken.');
          return FALSE;
        }
  }

  public function is_uniq_attr2($str, $field)
  { 

        list($fk,$uniq_fld_val)=explode('.', $field);
        $CI =& get_instance();

        $result = $CI->db
                      ->where('AD_Code', $str)
                      ->where('AD_FK_Code', $fk)
                      ->where('md5("AD_Code")||'."'-'".'||"AD_FK_Code" !=', $uniq_fld_val)
                      ->limit(1)
                      ->get("tblCOM_AttributeDetail")->num_rows();
                      // echo $this->db->last_query();
        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('is_uniq_attr2', 'The %s that you requested is already taken.');
          return FALSE;
        }
  }

   public function composite_unique($str, $field)
  { 

        list($tbl,$uniq_fld,$uniqfldval)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($uniq_fld,$uniqfldval)
                      ->limit(1)
                      ->get($tbl)->num_rows();
                      // echo $CI->db->last_query();
                      // exit();
        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('composite_unique', 'Combination already exist!');
          return FALSE;
        }
  }

  public function composite_unique2($str, $field)
  { 

        list($tbl,$uniq_fld,$uniqfldval,$uniq_idfld,$uniqidfldval)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($uniq_fld,$uniqfldval)
                      ->where($uniq_idfld.' !=',$uniqidfldval)
                      ->limit(1)
                      ->get($tbl)->num_rows();
                      // echo $this->db->last_query();

        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('composite_unique2', 'Combination already exist!');
          return FALSE;
        }
  }

   public function is_unique2($str, $field)
  { 

        list($table, $field, $uniq_fld,$uniq_fld_val)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($field, $str)
                      ->where($uniq_fld.' !=', $uniq_fld_val)
                      ->limit(1)
                      ->get($table)->num_rows();

        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('is_unique2', 'The %s that you requested is already taken.');
          return FALSE;
        }
  }
  
   public function is_unique3($str, $field)
  { 

        list($table, $field, $uniq_fld,$uniq_fld_val)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($field, $str)
                      ->where($uniq_fld, $uniq_fld_val)
                      ->limit(1)
                      ->get($table)->num_rows();

        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('is_unique3', 'The %s that you requested is already taken.');
          return FALSE;
        }
  }

  public function is_unique4($str, $field)
  { 

        list($table, $field, $uniq_fld,$uniq_fld_val,$uniq_fk_fld,$uniq_fk_val)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($field, $str)
                      ->where($uniq_fld.' !=', $uniq_fld_val)
                      ->where($uniq_fk_fld, $uniq_fk_val)
                      ->limit(1)
                      ->get($table)->num_rows();
                      
        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('is_unique4', 'The %s that you requested is already taken.');
          return FALSE;
        }
  }

  public function double_unique($str, $field)
  {     
       list($table, $field, $field1, $str1,$combi)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($field, $str)
                      ->where($field1, $str1)
                      ->limit(1)
                      ->get($table)->num_rows();

        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('double_unique', 'The %s, '.$combi.' combination is already taken.');
          return FALSE;
        }
  }

  public function double_unique2($str, $field)
  {     
       list($table,$field,$field1,$str1,$uniq_fld,$uniq_fld_val,$combi)=explode('.', $field);
        $CI =& get_instance();
        
        $result = $CI->db
                      ->where($field, $str)
                      ->where($field1, $str1)
                      ->where($uniq_fld.' !=', $uniq_fld_val)
                      ->limit(1)
                      ->get($table)->num_rows();       
        if(!$result){
          return TRUE;
        }else{
          $CI->form_validation->set_message('double_unique2', 'The %s, and '.$combi.' combination is already taken.');
          return FALSE;
        }
  }
 
}