<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_type_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_ItemType");
    }
    
  public function table_data($data){
    
    extract($data);

      $this->db->select(array("*",
                  'md5("IT_Id") as id',
                '(CASE WHEN "IT_Active" = '."'1'".' THEN '."'Active'".' WHEN "IT_Active" = '."'0'".' THEN '."'Inactive'".' END) as "IT_Active"'))
         ->group_by("tblINV_ItemType.IT_Id");

    if(isset($queries['search'])){
      $this->db->or_having(array(
                    'LOWER(CAST("IT_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
                    'LOWER(CAST("IT_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
                    'LOWER(CASE WHEN "IT_Active" = '."'1'".' THEN '."'Active'".' WHEN "IT_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
      $this->db->order_by("tblINV_ItemType.DateCreated DESC");
    }
      

    $count = $this->db->query($this->db->get_compiled_select("tblINV_ItemType",false));
    
    $this->db->limit($perPage,$offset);

    $result = $this->db->query($this->db->get_compiled_select());


    if($result->num_rows()>0){
      return  array('rows' => $count->num_rows(),
              'count'=> $this->record_count("tblINV_ItemType"),
                'data' => $result->result_array());
    }else{
      return FALSE;
    }
  }
  public function add_data($data){

    $it = $data['ITS_FK_Module_id'];
    unset($data['ITS_FK_Module_id']);

    $this->db->trans_start();
    $this->db->insert('tblINV_ItemType',add_data($data));
    foreach ($it as $key => $value) {
        $this->db->insert('tblINV_ItemTypeSetup',array('ITS_FK_Module_id'=>$value,'ITS_FK_ItemType_id'=>$data['IT_Id']));
    }
    $this->db->trans_complete();

    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }

  }
  public function update_main_data($where,$data){
    
    $this->db->trans_start();
  
    $this->db->where($where)
         ->update('tblINV_ItemType',update_data($data['item_type']));

    foreach ($data['delete'] as $key => $value) {
      $this->db->where(array('md5("ITS_FK_ItemType_id")' => $where['md5("IT_Id")']))
           ->where(array('ITS_FK_Module_id' => $value))
           ->delete("tblINV_ItemTypeSetup");
    }
    
    foreach ($data['add'] as $key => $value) {
      $this->db->insert("tblINV_ItemTypeSetup",array('ITS_FK_Module_id' => $value,'ITS_FK_ItemType_id' => $data['item_type']['IT_Id']));
    }
       
    $this->db->trans_complete();
    
    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }

  }
}
