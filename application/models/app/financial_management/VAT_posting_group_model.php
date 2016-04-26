<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vat_posting_group_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }

  public function table_data($data){

		extract($data);

	      $this->db->select(array("*",
	    						'md5("VBPG_Code") as id',
								'(CASE WHEN "VBPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "VBPG_Active" = '."'0'".' THEN '."'Inactive'".' END) as "VBPG_Active"'))
				 ->group_by("tblACC_VATBusPostingGroup.VBPG_Code");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("VBPG_Code" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("VBPG_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "VBPG_Active" = '."'1'".' THEN '."'Active'".' WHEN "VBPG_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by('tblACC_VATBusPostingGroup.VBPG_Code ASC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_VATBusPostingGroup",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
				  		   'count'=> $this->record_count(),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
  public function record_count(){
	  	$result =	$this->db->select('COUNT(*)')
		    		 		 ->get("tblACC_VATBusPostingGroup");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
   							 ->where(array('VBPG_Active' => '1'))
	    		 			 ->get("tblACC_VATBusPostingGroup");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

   public function get_spec_data($where){

		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblACC_VATBusPostingGroup");

	    return $result->row_array();
  }


  public function add_data($data){

	  	$this->db->insert('tblACC_VATBusPostingGroup',add_data($data));

	  	$this->insert_prod($data);

	  	if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}
  }

  public function insert_prod($data){

  	$prod  = array( 'VPPG_Code'        => $data['VBPG_Code'],
        		    'VPPG_Description' => $data['VBPG_Description'],
        		    'VPPG_Active'      => '1');

	$this->db->insert("tblACC_VATProdPostingGroup",add_data($prod));
  }

   public function update_prod($where,$data){

   		$prod  = array( 'VPPG_Code'        => $data['VBPG_Code'],
        		   		'VPPG_Description' => $data['VBPG_Description']);

   		$this->db->where(array('md5("VPPG_Code")' => $where['md5("VBPG_Code"::text)']))
	  			 ->update('tblACC_VATProdPostingGroup',update_data($prod));

	  	if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}


  }

  public function update_data($where,$data){
	
		$this->db->where($where)
	  			 ->update('tblACC_VATBusPostingGroup',update_data($data));

	  	$this->update_prod($where,$data);

	  	if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}

  	}


  public function delete_prod($where){

  	$this->db->where(array('md5("VPPG_Code")' => $where['md5("VBPG_Code"::text)']))
  			 ->delete('tblACC_VATProdPostingGroup');

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

	

 public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblACC_VATBusPostingGroup');

  	$this->delete_prod($where);

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
