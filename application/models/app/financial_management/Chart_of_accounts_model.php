<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart_of_accounts_model extends MY_Model {


  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_ChartAccount");
    }

  public function table_data($data){
  
     extract($data);

      $this->db->select(array("COA_Account_id",
                              "COA_AccountName",
                              'md5("COA_Account_id") as id',
                            '(CASE WHEN "COA_Active" = '."'1'".' THEN '."'Active'".' WHEN "COA_Active" = '."'0'".' THEN '."'Inactive'".' END) as "COA_Active"'))
         ->group_by("tblACC_ChartAccount.COA_Account_id");

    if(isset($queries['search'])){
      $this->db->or_having(array(
                    'LOWER(CAST("COA_Account_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
                    'LOWER(CAST("COA_AccountName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
                    'LOWER(CASE WHEN "COA_Active" = '."'1'".' THEN '."'Active'".' WHEN "COA_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
                    ));
    }


    if(isset($sorts)){
      $res = array();
      foreach ($sorts as $key => $value) {
        $order = $value == 1 ? "ASC" : "DESC";
        array_push($res,  $key." ".$order);
      }
      $this->db->order_by(implode(",", $res));
    }else{
      $this->db->order_by('tblACC_ChartAccount.COA_Account_id ASC');
    }
      

    $count = $this->db->query($this->db->get_compiled_select("tblACC_ChartAccount",false));
    
    $this->db->limit($perPage,$offset);

    $result = $this->db->query($this->db->get_compiled_select());

    if($result->num_rows()>0){
      return  array('rows' => $count->num_rows(),
              'count'=> $this->record_count("tblACC_ChartAccount"),
                'data' => $result->result_array());
    }else{
      return FALSE;
    }
  }
}
