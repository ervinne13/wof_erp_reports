<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_profile_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_StoreProfile");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("*",
	    						'md5("SP_DocNo") as id',
								'(CASE WHEN "SP_Active" = '."'1'".' THEN '."'Active'".' WHEN "SP_Active" = '."'0'".' THEN '."'Inactive'".' END) as "SP_Active"'))
				 ->group_by("tblINV_StoreProfile.SP_StoreID");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("SP_StoreID" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SP_StoreName" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SP_Address" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("SP_TelNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "SP_Active" = '."'1'".' THEN '."'Active'".' WHEN "SP_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
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
			$this->db->order_by("tblINV_StoreProfile.DateCreated DESC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblINV_StoreProfile",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblINV_StoreProfile"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
  public function add_data($data){

  	$this->db->trans_start();

  	if($data['SP_StoreType'] != 3){
		$cpc_class = $data['SP_StoreType'] == 1 ? 1 : 2;

		$this->db->insert('tblCOM_CPCenter',add_data(array('CPC_Id'		   => 'CPC-'.$data['SP_StoreID'],
														   'CPC_Desc' 	   => $data['SP_StoreName'],
														   'CPC_Active'	   => '1',
														   'CPC_FK_Class'  => $cpc_class
															)));
		$data['SP_FK_CPC_id'] = 'CPC-'.$data['SP_StoreID'];
	} 	

  	$this->db->insert('tblINV_StoreProfile',add_data($data));
  	$this->db->trans_complete();
  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->trans_start();

	if(isset($data['SP_StoreType']) && $data['SP_StoreType'] != 3){
		$result = $this->get_spec_data_row($where);

		$cpc_class = $data['SP_StoreType'] == 1 ? 1 : 2;
		
		$cpc = 	$this->db->where(array('CPC_Id'=>'CPC-'.$result['SP_StoreID']))
	 					 ->get("tblCOM_CPCenter");		
	 	
	 	$cpcdata = array('CPC_Id'		=> 'CPC-'.$data['SP_StoreID'],
				   		 'CPC_Desc' 	=> $data['SP_StoreName'],
				   		 'CPC_Active'	=> '1',
				   		 'CPC_FK_Class' => $cpc_class
						);
		
	 	if($cpc->num_rows() > 0){
			unset($cpcdata['CPC_Active']);
	 		$this->db->where(array('CPC_Id'=>$result['SP_FK_CPC_id']))
					 ->update('tblCOM_CPCenter',update_data($cpcdata));
			$data['SP_FK_CPC_id'] = 'CPC-'.$data['SP_StoreID'];
	 	}else{
	 		$this->db->insert('tblCOM_CPCenter',add_data($cpcdata));
			$data['SP_FK_CPC_id'] = 'CPC-'.$data['SP_StoreID'];

		}

	} 
	$this->db->where($where)
  			 ->update('tblINV_StoreProfile',update_data($data));

  	$this->db->trans_complete();

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

}
