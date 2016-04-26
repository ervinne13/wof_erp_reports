<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Machine_items_model extends MY_Model {

	protected $table = "tblINV_MachineItems";

	public function __construct()
    {
        parent::__construct();
        $this->set_table($this->table);
    }

 public function table_data($data){

		extract($data);

	    $this->db->select(array('*','md5("MCI_MC_IM_Item_id"::text) as "id"',
								'"MCI_MC_MachineTag" as "MachineTag"'))
				 ->group_by("tblINV_MachineItems.MCI_MC_IM_Item_id","tblINV_MachineItems.MCI_MC_MachineTag");	

  }

  //USED ON DISPENSE TICKET
    public function findDoc($dispense, $machine, $location) {
        $pditems_condition = array(

            'MCI_Location' 	=> $location,
            'MCI_MC_MachineTag'  => $machine['MCI_MC_MachineTag'],
            'MCI_Retrieved'       => '0'
        );

        return $this->get_spec_data_row($pditems_condition);
    }



  // public function get_machine_tickets_array($fields,$where){ 


  // 		$result = $this->db->select(array('MCT_DeckNo','MCT_SeriesFrom','MCT_SeriesTo',
		// 								   '0 as DIT_QtyIssued','MCT_Remaining'))             
			
  //               ->join('tblINV_Machine','tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag','left')            
	 // 		    ->where($where)	 		   
	 // 		     ->order_by('tblINV_MachineTickets.MCT_DeckNo')
	 // 		    ->get("tblINV_MachineTickets");
	 		    
		// 		// ->join('tblINV_Machine','tblINV_Machine.MC_MachineTag = tblINV_MachineTickets.MCT_MC_MachineTag','left') 
  //               // ->join('tblINV_Machine','tblINV_Machine.MC_IM_Item_id = tblINV_MachineTickets.MCT_MC_IM_Item_id','left')              	               
 	// 		// ECHO json_encode($result);
 	// 		// exit();

  //       return array('rows'     => $result->num_rows(),
  //                    'data'     => $result->result_array()); 
       
  // }


 		//USED ON PDITEMS COUNT
        public function get_machineitem($id,$location) {
	        $this->db->select(array(
	                    "MCI_DocNo",
	                    "MCI_LineNo",
	                    "MCI_QtyIssued",
	                    "MCI_Remaining",
	                    "MCI_Retrieved",
	                    "MCI_MC_IM_Item_id",
	                    "MCI_MC_MachineTag",
	                    "IM_Sales_Desc",	                    
	                    'md5("MC_MachineTag") as id'
	                ))

	                ->join("tblINV_Machine", "tblINV_Machine.MC_MachineTag = tblINV_MachineItems.MCI_MC_MachineTag" ,"INNER")
	                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "INNER")
	                
	                ->where(array(
	                    'md5("MC_MachineTag")' => $id,
	                    'MC_Location' => $location,
	                    'MCI_Retrieved' => '0'
	                    
	        		));
	        	
	        $result = $this->db->get("tblINV_MachineItems");	     	        
	      
	        // echo $this->db->last_query();
	        return $result->row_array();
    	}



    	//USED ON DISPENSE TICKET
    	 public function get_spec_machineitem($id,$location,$machine_result) {
	        $this->db->select(array(	                   
	                    "MCI_LineNo",
	                    "MCI_QtyIssued",
	                    "MCI_Remaining",
	                    "MCI_Retrieved",
	                    "MC_IM_Item_id",
	                    "MCI_MC_IM_Item_id",
	                    "IM_Sales_Desc",
	                    'md5("MC_MachineTag") as id'
	                ))

	                ->join("tblINV_Machine", "tblINV_Machine.MC_MachineTag = tblINV_MachineItems.MCI_MC_MachineTag" ,"INNER")
	                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "INNER")
	                
	                ->where(array(
	                    'md5("MCI_MC_IM_Item_id")' => $id,
	                    'MC_Location' => $location,	                    
	                    'MCI_Retrieved' => '0'	                    
	        		))
	        		->order_by("tblINV_MachineItems.MCI_LineNo");
	        	
	        $result = $this->db->get("tblINV_MachineItems");	     	        

	        return $result->row_array();
    	}





    	//USED ON DISPENSE TICKET
        public function get_machine_pditem_array($field,$Where) {
        	
	        $this->db->select($field)

	                ->join("tblINV_Machine", "tblINV_Machine.MC_MachineTag = tblINV_MachineItems.MCI_MC_MachineTag" ,"INNER")
	                ->join("tblINV_Item", "tblINV_Item.IM_Item_id = tblINV_Machine.MC_IM_Item_id", "INNER")
	                
	                ->where($Where)
	                ->order_by("tblINV_MachineItems.MCI_LineNo");
	                    
	       		        	
	        $result = $this->db->get("tblINV_MachineItems");	  

	        // echo $this->db->last_query(); 

		return $result->result_array(); 

	       	// return array(
         //        'rows' => $result->num_rows(),
         //        'data' => $result->result_array());
	       
    	}
    
    

   
}