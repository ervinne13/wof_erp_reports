<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Set_Default
{
  private $config   = array();

  public function set_config($data=array()){
    
    foreach ($data as $key => $value) {
      $this->config[$key] =  $value;
    }

  }
 
  public function run(){

    foreach ($this->config as $key => $value) {
      
      if($value=="null" && (TRIM($_POST[$key]) == '')){
        $_POST[$key] = NULL;
      }
      if($value=="blank" && (TRIM($_POST[$key]) == '')){
        $_POST[$key] = '';
      }
      if($value=="numeric"){
        $_POST[$key] = $this->set_numeric($key);
      }
      if($value=="integer"){
        $_POST[$key] = $this->set_integer($key);
      }
    }
    
  }

  private function set_numeric($key){

    return !empty($_POST[$key]) || TRIM($_POST[$key]) != ''? number_format(str_replace(',', '', $_POST[$key]),4,'.','') : 0.0000;

  }

   private function set_integer($key){

    return !empty($_POST[$key]) || TRIM($_POST[$key]) != ''? (int) str_replace(',', '', $_POST[$key]) : 0;

  }

}