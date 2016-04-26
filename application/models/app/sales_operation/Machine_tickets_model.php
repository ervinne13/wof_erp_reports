<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Machine_tickets_model extends MY_Model {

	protected $table = "tblINV_MachineTickets";

	public function __construct()
    {
        parent::__construct();
        $this->set_table($this->table);
    }

 public function table_data($data){

		extract($data);

	    $this->db->select(array('*','md5("MCT_MC_IM_Item_id"::text) as "id"',
								'"MCT_MC_MachineTag" as "MachineTag"'))
				 ->group_by("tblINV_MachineTickets.MCT_MC_IM_Item_id","tblINV_MachineTickets.MCT_MC_MachineTag");	

  }

  //USED ON DISPENSE TICKET
    public function findDoc($dispense, $machine, $location) {
        $dispense_ticket_condition = array(

            'MCT_Location' 	=> $location,
            'MCT_MC_MachineTag'  => $machine['MCT_MC_MachineTag'],
            'MCT_Retrieved'       => '0'
        );

        return $this->get_spec_data_row($dispense_ticket_condition);
    }



  public function get_machine_tickets_array($fields,$where){ 


  		$result = $this->db->select(array('MCT_DeckNo','MCT_SeriesFrom','MCT_SeriesTo',
										   '0 as DIT_QtyIssued','MCT_Remaining'))             
			
                ->join('tblINV_Machine','tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag','left')            
	 		    ->where($where)	 		   
	 		     ->order_by('tblINV_MachineTickets.MCT_DeckNo')
	 		    ->get("tblINV_MachineTickets");
	 		    
				// ->join('tblINV_Machine','tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag','left') 
                // ->join('tblINV_Machine','tblINV_Machine.MC_IM_Item_id = tblINV_MachineTickets.MCT_MC_IM_Item_id','left')              	               
 			// ECHO json_encode($result);
 			// exit();

        return array('rows'     => $result->num_rows(),
                     'data'     => $result->result_array()); 
       
  }



 		//USED ON DISPENSE TICKET
        public function get_machineitem($id,$location) {
	        $this->db->select(array(
	                    "MCT_DocNo",
	                    "MCT_LineNo",
	                    "MCT_DeckNo",
	                    "MCT_SeriesFrom",
	                    "MCT_SeriesTo",
	                    "MCT_Retrieved",
	                    "MC_IM_Item_id",
	                    "MCT_MC_MachineTag",
	                    "IM_Sales_Desc",
	                    "MCT_Retrieved",
	                    'md5("MC_MachineTag") as id'
	                ))

	                ->join("tblINV_Machine", "tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag" ,"INNER")
	                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "INNER")
	                
	                ->where(array(
	                    'md5("MC_MachineTag")' => $id,
	                    'MC_Location' => $location,
	                    'MCT_Retrieved' => '0'
	                    
	        		));
	        	
	        $result = $this->db->get("tblINV_MachineTickets");	     	        
	      
	     	// return array('rows'     => $result->num_rows(),
       //               	 'data'     => $result->result_array()); 
	        return $result->row_array();
    	}

    	//USED ON DISPENSE TICKET
    	 public function get_spec_machineitem($id,$location,$machine_result) {
	        $this->db->select(array(	                   
	                    "MCT_LineNo",
	                    "MCT_DeckNo",
	                    "MCT_SeriesFrom",
	                    "MCT_SeriesTo",
	                    "MCT_Retrieved",
	                    "MC_IM_Item_id",
	                    "MCT_MC_MachineTag",
	                    "IM_Sales_Desc",
	                    "MCT_Retrieved",
	                    'md5("MC_MachineTag") as id'
	                ))

	                ->join("tblINV_Machine", "tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag" ,"INNER")
	                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "INNER")
	                
	                ->where(array(
	                    'md5("MCT_MC_MachineTag")' => $id,
	                    'MC_Location' => $location,	                    
	                    'MCT_Retrieved' => '0'	                    
	        		))
	        		->order_by("tblINV_MachineTickets.MCT_LineNo");
	        	
	        $result = $this->db->get("tblINV_MachineTickets");	     	        

	        return $result->row_array();
    	}





    	 		//USED ON DISPENSE TICKET
        public function get_machine_item_array($field,$Where) {
        	
	        $this->db->select($field)

	                ->join("tblINV_Machine", "tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag" ,"INNER")
	                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "INNER")
	                
	                ->where($Where)
	                ->order_by("tblINV_MachineTickets.MCT_LineNo");
	                    
	       		        	
	        $result = $this->db->get("tblINV_MachineTickets");	   

		return $result->result_array(); 

	       	// return array(
         //        'rows' => $result->num_rows(),
         //        'data' => $result->result_array());
	       
    	}
    
    

   
}