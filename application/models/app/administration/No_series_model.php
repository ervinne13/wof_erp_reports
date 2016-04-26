<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class No_series_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_NoSeries");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('NS_Id',
	    	    				'NS_Description',
	    	    				'md5("NS_Id") as id',
	    						'NS_StartNo',
	    						'NS_EndingNo',
	    						'M_Description',
	    						'NS_FK_Module_id',
	    						'NS_Location',
	    						"COALESCE(".'"NS_LastNoUsed"::text'.",'') as  ".'"NS_LastNoUsed"'." ",
	    						"COALESCE(".'"NS_LastDateUsed":: text'.",'') as ".'"NS_LastDateUsed"'." "))
				 ->join('tblCOM_Module','tblCOM_NoSeries.NS_FK_Module_id = tblCOM_Module.M_Module_id','left')
				 ->group_by("NS_Id,M_Module_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("NS_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("NS_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("M_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("NS_LastNoUsed" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('date("tblCOM_NoSeries"."NS_LastDateUsed") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('date("tblCOM_NoSeries"."NS_LastDateUsed") <=' => $queries['date-to']));
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by("tblCOM_NoSeries.NS_Id ASC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_NoSeries",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						        'count'=> $this->record_count("tblCOM_NoSeries"),
					  	      'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

  // public function set_default($data){
  // 	$this->db->trans_begin();
  // 	$this->db->where(array('NS_FK_Module_id'=>$data['module']))
  // 		 	 ->update('tblCOM_NoSeries',array('NS_Default'=>'0'));

  // 	$this->db->where(array('NS_Id'=>$data['id']))
  // 		 	 ->update('tblCOM_NoSeries',array('NS_Default'=>'1'));

  // 	if ($this->db->trans_status() === FALSE) {
  //       $this->db->trans_rollback();
  //       return 0;
  //   } else {
  //       $this->db->trans_commit();
  //       return 1;
  //   }
  // }

  public function get_spec_data($where){

		$result =	$this->db->select(array('*','MD5("NS_Id"||'."'-'".'||"NS_LastNoUsed"::text) as id'))
	 						 ->where($where)
	 						 ->get("tblCOM_NoSeries");

	    return $result->row_array();
  }

  public function getseries_update($id){
  	$result = $this->db->select('COUNT(*)')
  					   ->where(array('NS_FK_Module_id' => $id))
  					   ->where('COALESCE("NS_LastNoUsed","NS_StartNo") < "NS_EndingNo"')
  			 		   ->get('tblCOM_NoSeries');
  	
  	$res = $result->result_array();
	return array('rows' => $result->row_array()['count']);
  }

  function get_no_series_issuance($data,$table='',$pk='',$pk2=null){
  	$this->db->trans_start();

  	$result = $this->db->select(array('*','MD5("NS_Id") as id','MD5("NS_Id"||'."'-'".'||(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)) as uniq','(COALESCE("NS_LastNoUsed","NS_StartNo") + 1) as nsnum'))
  					   ->join('tblCOM_Module','M_Module_id = NS_FK_Module_id','left')
  					   ->where(array('NS_FK_Module_id' => $data))
  					   ->where('COALESCE("NS_LastNoUsed","NS_StartNo") < "NS_EndingNo"')
  					   ->where_in('NS_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    			   ->get('tblCOM_NoSeries');			   
  	$res = $result->result_array();	

  	if($result->num_rows()==1){
  		$this->db->set('"NS_LastNoUsed"', '(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)', FALSE)
				 ->where(array('NS_FK_Module_id' => $data))
				 ->update('tblCOM_NoSeries');
		if($pk2){
			$ins = array_merge(array($pk => $res[0]['NS_Id'].'-'.$res[0]['nsnum']),$pk2);
		}else{
			$ins = array($pk => $res[0]['NS_Id'].'-'.$res[0]['nsnum']);
		}

		$this->db->insert($table,add_data($ins));	
  	}

  	$this->db->trans_complete();
  	return array('rows' => $result->num_rows(), 'ins' => $ins,
  				 'data' => $res);
  }


    function get_no_series($data,$table='',$pk='',$pk2=null){
  	$this->db->trans_start();

  	$result = $this->db->select(array('*','MD5("NS_Id") as id','MD5("NS_Id"||'."'-'".'||(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)) as uniq','(COALESCE("NS_LastNoUsed","NS_StartNo") + 1) as nsnum'))
  					   ->join('tblCOM_Module','M_Module_id = NS_FK_Module_id','left')
  					   ->where(array('NS_FK_Module_id' => $data))
  					   ->where('COALESCE("NS_LastNoUsed","NS_StartNo") < "NS_EndingNo"')
  					   ->where_in('NS_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    			   ->get('tblCOM_NoSeries');			   
  	$res = $result->result_array();	

  	if($result->num_rows()==1){
  		$this->db->set('"NS_LastNoUsed"', '(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)', FALSE)
				 ->where(array('NS_FK_Module_id' => $data))
				 ->update('tblCOM_NoSeries');
		if($pk2){
			$ins = array_merge(array($pk => $res[0]['NS_Id'].'-'.$res[0]['nsnum']),$pk2);
		}else{
			$ins = array($pk => $res[0]['NS_Id'].'-'.$res[0]['nsnum']);
		}

		$this->db->insert($table,add_data($ins));	
  	}

  	$this->db->trans_complete();
  	return array('rows' => $result->num_rows(),
  				 'data' => $res);
  }


  function generate_no($data,$table='',$pk='',$pk2=null, $insert = TRUE){
  	$this->db->trans_start();

  	$result = $this->db->select(array('*','MD5("NS_Id") as id','MD5("NS_Id"||'."'-'".'||(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)) as uniq','(COALESCE("NS_LastNoUsed","NS_StartNo") + 1) as nsnum'))
  					   ->join('tblCOM_Module','M_Module_id = NS_FK_Module_id','left')
  					   ->where(array('NS_FK_Module_id' => $data))
  					   ->where('COALESCE("NS_LastNoUsed","NS_StartNo") < "NS_EndingNo"')
  					   ->where_in('NS_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    			   ->get('tblCOM_NoSeries');			   
  	$res = $result->result_array();	

  	if($insert && $result->num_rows()==1){
  		$this->db->set('"NS_LastNoUsed"', '(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)', FALSE)
				 ->where(array('NS_FK_Module_id' => $data))
				 ->update('tblCOM_NoSeries');
		if($pk2){
			$ins = array_merge(array($pk => $res[0]['NS_Id'].'-'.$res[0]['nsnum']),$pk2);
		}else{
			$ins = array($pk => $res[0]['NS_Id'].'-'.$res[0]['nsnum']);
		}

  	}

  	$this->db->trans_complete();
  	return array('rows' => $result->num_rows(),
  				 'data' => $res);
  }

  public function add_data_series($data,$table,$pk,$act=null,$att=null){

  	$this->db->trans_start();
  		$where = array('MD5("NS_Id")' => $data['NS_Id']);
  		$this->db->set('"NS_LastNoUsed"', '(COALESCE("NS_LastNoUsed","NS_StartNo") + 1)', FALSE)
				 ->where($where)
				 ->update('tblCOM_NoSeries');
  		$data = $this->get_spec_data($where);
  		$ins = add_data(array($pk=>$data['NS_Id'].'-'.$data['NS_LastNoUsed']));
  		if($att){
  			$ins = array_merge($ins,$att);
  		}

  		if($act){
  			$ins = array_merge($ins,array($act=>'0'));
  		}

		$this->db->insert($table,$ins);	

  	$this->db->trans_complete();
		
		if($this->db->affected_rows() > 0){
  			return $data;
	  	}else{
	  		return FALSE;
	  	}	 
  
  }
  
  

}
