<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{   
    private $table = NULL;

    public function __construct()
    {
        parent::__construct();
    }

    public function set_table($table){
        $this->table = $table;
    }

    public function record_count(){
        $result =   $this->db->select('COUNT(*)')
                         ->get($this->table);

        return $result->row_array()['count'];
    }

    public function add_data($data){
        try {
            return $this->db->insert($this->table, add_data($data));
        }catch (Exception $e) {
        var_dump($data); exit;
        }

         
    }

    public function update_data($where,$data){

        $result = $this->db->where($where)
             ->update($this->table,update_data($data)); 

        return $result;
    }

    public function get_all_data(){

        $result =   $this->db->select('*')
                             ->get($this->table);
        return array('rows' => $result->num_rows(),
                     'data' => $result->result_array());
    }

    public function get_all_data_join($joins=array()){

        $this->db->select('*');
                             
        if(count($joins)>0){
            foreach ($joins as $key => $value) {
                $this->db->join($value['table'],$value['connector'],isset($value['type'])?$value['type']:'left');
            }
        }

        $result =  $this->db->get($this->table);
        
        return array('rows' => $result->num_rows(),
                     'data' => $result->result_array());
    }

    public function get_spec_data_row($where,$joins=array()){

        $this->db->select('*')
                  ->where($where);

        if(count($joins)>0){
            foreach ($joins as $key => $value) {
                $this->db->join($value['table'],$value['connector'],isset($value['type'])?$value['type']:'left');
            }
        }

        $result =  $this->db->get($this->table);

        return $result->row_array();
    }

    public function get_spec_data_row_spec_fields($fields,$where,$joins=array()){

        $this->db->select($fields)
                  ->where($where);
                  
        if(count($joins)>0){
            foreach ($joins as $key => $value) {
                $this->db->join($value['table'],$value['connector'],isset($value['type'])?$value['type']:'left');
            }
        }

        $result =  $this->db->get($this->table);

        return $result->row_array();
    }
    
    public function get_spec_data_array($where,$joins=array()){

        $this->db->select('*')
                  ->where($where);

        if(count($joins)>0){
            foreach ($joins as $key => $value) {
                $this->db->join($value['table'],$value['connector'],isset($value['type'])?$value['type']:'left');
            }
        }

        $result =  $this->db->get($this->table);
   
        return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());

    }

    //for physical count filtering itemtype
     public function get_spec_item_array($where,$joins=array()){

       $result = $this->db->select('*')
           ->join('tblINV_PCountSetup','tblINV_PCountSetup.PCS_ItemType = tblINV_ItemType.IT_Id','left')
           ->where('tblINV_PCountSetup.PCS_ItemType', NULL)
           ->where($where);
           
        if(count($joins)>0){
            foreach ($joins as $key => $value) {
                $this->db->join($value['table'],$value['connector'],isset($value['type'])?$value['type']:'left');
            }
        }

        $result =  $this->db->get($this->table);
   
        return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());

    }

    public function get_spec_data_array_spec_fields($fields,$where,$joins=array()){

        $this->db->select($fields)
                  ->where($where);
                  
        if(count($joins)>0){
            foreach ($joins as $key => $value) {
                $this->db->join($value['table'],$value['connector'],isset($value['type'])?$value['type']:'left');
            }
        }
        $result =  $this->db->get($this->table);

        // print_r($this->db->error());
        // exit();
        return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array());
    
    }
   
     public function delete($where){

        $this->db->where($where)
                 ->delete($this->table);

        if($this->db->error()['code']==00000){
            if($this->db->affected_rows() > 0){ 
                return 1;
            }else{
                return 0;
            }
        }else{
            die($this->db_errors->error($this->db->error()['code']));
        }

    }
}
