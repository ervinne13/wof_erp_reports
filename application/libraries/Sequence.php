<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Sequence
{
  public function next_attr_id($filter)
  { 

        $CI =& get_instance();
        $result = $CI->db
                      ->select("AD_Code")
                      ->where("AD_FK_Code", $filter)
                      ->limit(1)
                      ->order_by('DateCreated DESC')
                      ->get("tblCOM_AttributeDetail")->row();

        if(!$result){
           return $filter.'-1';
        }else{
           return $filter.'-'.(explode('-', $result->ad_code)[1]+1);
        }
  }
   public function next_doc_num($filter=false){

        $CI =& get_instance();
        
        $result =  $CI->db
                      ->select(array("(ns_id || '-' || (CASE WHEN ns_lastnoused::int < ns_endingno::int THEN (COALESCE(".'"ns_lastnoused"::int'.",".'"ns_startno"::int'.")+ 1) WHEN ns_startno >= ns_endingno THEN  0 END))  as  doc_num"))
                      ->where("ns_id", 'PR')
                      ->get("tblCOM_NoSeries")->row();
 
        if($result){
          return $result->doc_num;
        }else{
          return FALSE;
        }

   }

}