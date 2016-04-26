<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_tracking_model extends CI_Model {
  
  private $spec_function_per_module = array();

  private $functions  =  array();

  public function __construct()
    {
        parent::__construct();
    }

  public function get_module_function($module){

  	$position_id = $this->session->userdata('U_FK_Position_id');

  	

  }

  private function get_higher_position($id,$return = array()){
 
  	$sender 	= $this->get_approver_id(array('P_Position_id'=>$id));
	$approver 	= $sender['P_Parent'];

	if($approver != ""){
		$return[floor($approver/1000)*1000] = $this->get_approver_id(array('P_Position_id'=>$approver));
  		return $this->get_higher_position($approver,$return);
  	}else{
		return $return;
  	}

  }

  private function get_approver_id($where){
  		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblCOM_Position");
	    return $result->row_array();
  }

  private function get_spec_approvers($where,$sequence){

  	 $sequence = $sequence?'AND "AS_Sequence" > '.$sequence['AS_Sequence']:'';
  	 
	 $result = $this->db->select(array('"NS_Id" as id',
	    						"NS_Id",
	    						"M_Description",
								'(select json_agg(d)
      								FROM (
									        SELECT "AS_FK_Position_id","AS_Sequence","AS_Amount","AS_Unlimited"
									        FROM "tblCOM_ApprovalSetup" d
											LEFT JOIN "tblCOM_Position" ON "P_Position_id" = "AS_FK_Position_id"
        									where "AS_FK_NS_id"="NS_Id" '.$sequence.'
											ORDER BY "AS_Sequence"
      									 ) d
    							 ) as setup'))
	    		 ->join("tblCOM_Module",'M_Module_id = NS_FK_Module_id','left')
	    		 ->where($where)
	    		 ->group_by('NS_Id,M_Description')
	    		 ->get("tblCOM_NoSeries");
	    		 
	    return $result->row_array();
  }

  private function get_approver_sequence_per_position($where){
		
		$result =	$this->db->select('*')
	 						 ->where($where)
	 						 ->get("tblCOM_ApprovalSetup");
					 
	    return $result->row_array();

  }

  public function send_approval($data){

		$special_approver = $this->get_higher_position($this->session->userdata('U_FK_Position_id'));
  		
  		$sender_position  = $this->session->userdata('U_FK_Position_id');

  		$sender_sequence  = $this->get_approver_sequence_per_position(array("AS_FK_NS_id" => explode('-', $data['DT_DocNo'])[0],'AS_FK_Position_id' => $sender_position));

		$approvers = $this->get_spec_approvers(array("NS_Id" => explode('-', $data['DT_DocNo'])[0]),$sender_sequence);

		$approvers = json_decode($approvers['setup']);

	  	$default = array(
	  					 'DT_Status'   	=> 'Pending', 
	  					 'DT_Sender'   	=> $this->session->userdata('U_User_id'), 
	  					 'DT_EntryDate' => date("Y-m-d H:i:s",time()), 
	  					);

	  	foreach ($approvers as $key => $value) {
	  		
	  		$result = array_merge($default,$data);
	  		
	  		if(in_array($value->AS_FK_Position_id, array('2000','3000','4000')) && $sender_position < $value->AS_FK_Position_id){
	  			$result['DT_Approver'] = $special_approver[$value->AS_FK_Position_id]['P_Position_id'];
	  		}else{
	  			$result['DT_Approver'] = $value->AS_FK_Position_id;
	  		}
	  				
			$this->db->insert('tblCOM_DocTracking',$result);
			
		}

		if($this->db->affected_rows() > 0){
	  		return 1;
	  	}else{
	  		return 0;
	  	}
  }
  		
}
