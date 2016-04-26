<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class DB_Errors
{
  private $errors = array(
                        '23503/7' => 'You cannot delete items with details'
                        );

  public function error($errorcode){
      
      return isset($this->errors[$errorcode])?$this->errors[$errorcode]:'Call System Administrator';

  }
 
  

}