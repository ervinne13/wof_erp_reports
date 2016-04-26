<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_setup_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_ApprovalSetup");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array('MD5("NS_Id") as id',
	    						"NS_Id",
	    						"M_Description",
								'(select json_agg(d)
      								FROM (
									        SELECT "P_Position","AS_Sequence","AS_Amount","AS_Unlimited","AS_Required"
									        FROM "tblCOM_ApprovalSetup" d
											LEFT JOIN "tblCOM_Position" ON "P_Position_id" = "AS_FK_Position_id"
        									where "AS_FK_NS_id"="NS_Id"
											ORDER BY "AS_Sequence"
      									 ) d
    							 ) as setup'))
	    		 ->join("tblCOM_Module",'M_Module_id = NS_FK_Module_id','left')
	    		 ->group_by('NS_Id,M_Description');

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("NS_Id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("M_Description" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
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
  
  public function get_spec_data($where){

	 $result = $this->db->select(array('"NS_Id" as id',
	    						"NS_Id",
	    						"M_Description",
								'(select json_agg(d)
      								FROM (
									        SELECT "AS_FK_Position_id","AS_Sequence","AS_Amount","AS_Unlimited","AS_Required"
									        FROM "tblCOM_ApprovalSetup" d
											LEFT JOIN "tblCOM_Position" ON "P_Position_id" = "AS_FK_Position_id"
        									where "AS_FK_NS_id"="NS_Id"
											ORDER BY "AS_Sequence"
      									 ) d
    							 ) as setup'))
	    		 ->join("tblCOM_Module",'M_Module_id = NS_FK_Module_id','left')
	    		 ->where($where)
	    		 ->group_by('NS_Id,M_Description')
	    		 ->get("tblCOM_NoSeries");

	    return $result->row_array();
  }
  
  public function record_count(){
        $result =   $this->db->select('COUNT(*)')
                         ->get("tblCOM_NoSeries");

        return $result->row_array()['count'];
    }
    	
  public function update_data($where,$data){

	$this->db->trans_start();

	$ns = $this->db->select("NS_Id")
			   ->where(array('MD5("NS_Id")' => $where['md5("AS_FK_NS_id"::text)'] ))
			   ->get('tblCOM_NoSeries')->row_array();
  	
	$this->db->where($where)
			 ->delete("tblCOM_ApprovalSetup");


	$ctr = 1;
	if(isset($data['pos'])){
		foreach ($data['pos'] as $key => $value) {

			$this->db->insert("tblCOM_ApprovalSetup",add_data(array_merge($value,array('AS_Sequence'=>$ctr,'AS_FK_NS_id' => $ns['NS_Id']))));
	  		$ctr ++;	 
		}
	}

	$this->db->trans_complete();

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
  
}
