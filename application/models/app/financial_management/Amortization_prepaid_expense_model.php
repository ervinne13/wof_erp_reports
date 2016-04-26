<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amortization_prepaid_expense_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_AMPHeader");
    }

  public function table_data($data){

	    extract($data);

	    $this->db->select(array("*",
	    						'DATE("AMPH_DocDate") as "AMPH_DocDate"',
	    						'md5("AMPH_DocNo") as id',
	    						// '"COA_AccountName" as "Type"',
	    						)) 	
				 // ->join('tblACC_ChartAccount','COA_Account_id = AMPH_AmortType','left')
				 ->group_by("tblACC_AMPHeader.AMPH_DocNo");

		if(isset($queries['search'])){
			$this->db->group_start();
			$this->db->where(array('LOWER(CAST("AMPH_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMPH_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMPH_AmortAmount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMPH_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("AMPH_CostCenter" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->group_end();
										
		}

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("AMPH_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("AMPH_DocDate") <=' => $queries['date-to']));
		}
		
		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_AMPHeader.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblACC_AMPHeader",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

// print_r($this->db->error());
// exit();
		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						  'count'=> $this->record_count("tblACC_AMPHeader"),
					  	  'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }

  public function get_spec_data_row_spec_fields($fields,$where=array(),$join=array()){


        $result =   $this->db->select($fields)
                             ->join('tblACC_ChartAccount','COA_Account_id = AMPH_AmortType','left')
                             ->where($where)
                             ->get('tblACC_AMPHeader');  
                                                        
        return $result->row_array();
    }
    public function process_amprepaid($where,$data){

    	$this->db->where($where)
                 ->update("tblACC_AMPHeader",update_data($data));

      	$date   = $data['AMPH_StartingDate'];
        $nop    = $data['AMPH_NoOfPayment'];
        $period = $data['AMPH_Period'];
        $startingday 	= date("d",strtotime($data['AMPH_StartingDate']));
        $startingendday = date("t",strtotime($data['AMPH_StartingDate']));
        $dataarray = array();
        $marker = 0;
 		for($x=1; $x<=$nop; $x++){ 

	        $month  	= date("m",strtotime($date));    
	        $day   	 	= date("d",strtotime($date));
	        $year   	= date("Y",strtotime($date)); 
	        $loopdate 	= new DateTime();

 			if($period == 0){
 				if($startingday==$startingendday && $marker == 0){
					$loopdate->setDate($year, $month, 1);
					$date = strftime('%m/%d/%Y',strtotime("+1 months", strtotime($loopdate->format('m/d/Y'))));
					$marker = 1;
				}

       			$loopdate->setDate(date("Y",strtotime($date)), date("m",strtotime($date)), 1);
				$date = strftime('%m/%d/%Y',strtotime("+1 months", strtotime($loopdate->format('m/d/Y'))));
				array_push($dataarray,$loopdate->format('m/t/Y'));
			}else if($period == 1){
				if($startingday<=15){
	        		$loopdate->setDate($year, $month, 15);
 					array_push($dataarray,$loopdate->format('m/d/Y'));

					$x++;
					if($x>$nop){
						break;
					}
 					$loopdate->setDate($year, $month, 1);
 					array_push($dataarray,$loopdate->format('m/t/Y'));
 					
					$date = strftime('%m/%d/%Y',strtotime("+1 months", strtotime($loopdate->format('m/d/Y'))));
 				}else{
 					$loopdate->setDate($year, $month, 1);
 					array_push($dataarray,$loopdate->format('m/t/Y'));
					$date = strftime('%m/%d/%Y',strtotime("+1 months", strtotime($loopdate->format('m/d/Y'))));

					$x++;
					if($x>$nop){
						break;
					}

 					$loopdate->setDate(date("Y",strtotime($date)), date("m",strtotime($date)), 15);
 					array_push($dataarray,$loopdate->format('m/d/Y'));
 				}
 			}

 		}

 		$this->insert_amortization($dataarray,$data);
    }

    public function insert_amortization($dates,$data){

    	$this->db->where(array('AMPD_FK_DocNo' => $data['AMPH_DocNo']))
    			 ->delete('tblACC_AMPDetail');

    	$nop    = $data['AMPH_NoOfPayment'];
        $amount = $data['AMPH_AmortAmount'];
        
        $insert = array('AMPD_FK_DocNo'    => $data['AMPH_DocNo'],
        				// 'AMPD_Description' => $data['AMPH_AmortType'],
        				'AMPD_Amount'	   => $data['AMPH_AmortAmount'] / $data['AMPH_NoOfPayment'],
        				'AMPD_CPC' 		   => $data['AMPH_CostCenter']);
    	// $this->db->trans_start();
    	foreach ($dates as $key => $value) {
			$this->db->insert("tblACC_AMPDetail",add_data(array_merge($insert,array('AMPD_Date' => $value))));
		}

    	// $this->db->trans_complete();
    }
  
    public function get_rem_amount($where){

    	$now = date("Y-m-d",time());

    	$result = $this->db->select('SUM("AMPD_Amount") as total')
	 						 ->where(array('DATE("AMPD_Date") <' =>  $now))
	 						 ->where($where)
	 						 ->group_by('AMPD_FK_DocNo')
	 						 ->get("tblACC_AMPDetail"); 
	 	return $result->row_array();
    }

}
