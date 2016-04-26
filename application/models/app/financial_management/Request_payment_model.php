<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_payment_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_RPHeader");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("RPH_DocNo",
	    						'DATE("RPH_DocDate") as "RPH_DocDate"',
	    						"RPH_ExtDocNo",
	    						"RPH_SupplierName",
	    						"RPH_PaymentTerms",
	    						'DATE("RPH_DueDate") as "RPH_DueDate"',
	    						"RPH_Amount",
	    						"RPH_Reason",
	    						"RPH_Status",
	    						'md5("RPH_DocNo") as "id"'))
	    		 ->group_start()
	    		 ->where_in('RPH_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    		 ->or_where('RPH_Status','Cancel')
	    		 ->or_where('RPH_Status',NULL)
	    		 ->group_end()
				 ->group_by("tblACC_RPHeader.RPH_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("RPH_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("RPH_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("RPH_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_ExtDocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_SupplierName" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_PaymentTerms" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_DueDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_Reason" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("RPH_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
			$this->db->group_end();
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblACC_RPHeader.RPH_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_RPHeader",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		// print_r($this->db->error());
		// print_r($this->db->last_query());
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
					  		 ->where_in('RPH_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
				    		 ->or_where('RPH_Status','Cancel')
				    		 ->or_where('RPH_Status',NULL)
 		 					 ->get("tblACC_RPHeader");

	    return $result->row_array()['count'];
  	}
  	public function get_spec_cpc_per_rp($where){

		$result =	$this->db->select(array('SP_FK_CPC_id'))
	 						 ->join('tblINV_StoreProfile','RPH_Location = SP_StoreID','left')
	 						 ->where($where)
	 						 ->get("tblACC_RPHeader");
	    return $result->row_array();
  }

   public function get_cpc_per_rp($where){

		$result =	$this->db->select(array('SP_FK_CPC_id'))
	 						 ->where($where)
	 						 ->get("tblINV_StoreProfile");

	    return $result->row_array();
   }


  	public function update_rp($where,$data){

  		$details  = $data['details'];
  		unset($data['details']);
  		// $this->db->trans_begin();
  		$this->db->where($where)
  				 ->update('tblACC_RPHeader',$data);

  		$this->db->where(array('md5("RPD_PFK_DocNo")' => $where['md5("RPH_DocNo"::text)']))
  				 ->delete('tblACC_RPDetails');

  		$cpc = $this->get_cpc_per_rp(array('SP_StoreID' => $data['RPH_Location']));

  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){

					$VAT_WHT = $this->get_spec_item($value['RPD_ItemNo']);

					$value['RPD_VAT'] = $VAT_WHT['IM_VATProductPostingGroup'];
					$value['RPD_WHT'] = $VAT_WHT['IM_WHTProductPostingGroup'];

					$value['RPD_CPC'] = $cpc['SP_FK_CPC_id'];
		  			$value['RPD_PFK_DocNo'] = $data['RPH_DocNo'];

		  			$this->db->insert('tblACC_RPDetails',add_data($value));
		  		}
	  		}
  		}
  	
		// if ($this->db->trans_status() === FALSE) {
  //           $this->db->trans_rollback();
  //           return 0;
  //       } else {
  //       	$this->db->trans_commit();
  //           return 1;
  //       }
		  			
  	}

  	public function get_spec_item($item){
	  			$result =	$this->db->select(array('IM_VATProductPostingGroup','IM_WHTProductPostingGroup'))
		 						 ->where(array('IM_Item_id' => $item))
		 						 ->get("tblINV_Item");
		   		return $result->row_array();	
  		}

  	public function amount_in_lcy_rp($data){

    extract($data);
    
    $result = $this->db->select(array('(CASE WHEN "tblACC_RPHeader"."RPH_Currency" = "tblCOM_Company"."COM_Currency" THEN '.$amount.' ELSE '.$amount.' * "ER_ConvCurrencyRate" END) as amount ','COALESCE("ER_ConvCurrencyRate",1) as "ER_ConvCurrencyRate" '))
                       ->join('tblCOM_Company','RPH_Company = COM_Id','left')
                       ->join('tblACC_ExchangeRate','ER_FK_BaseCurrency_id = tblACC_RPHeader.RPH_Currency AND ER_FK_ConvCurrency_id = tblCOM_Company.COM_Currency','left')
                       ->where($where)
                       ->get("tblACC_RPHeader");                
    
    return $result->row_array();
   
    }
}
