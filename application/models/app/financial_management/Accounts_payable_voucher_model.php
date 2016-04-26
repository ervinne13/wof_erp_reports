<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts_payable_voucher_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblACC_APVHeader");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("APV_DocNo",
	    						'DATE("APV_DocDate") as "APV_DocDate"',
	    						"APV_SupplierName",
	    						"APV_Amount",
	    						"APV_DateRequired",
	    						"APV_Status",
	    						"APV_Remarks",
	    						'md5("APV_DocNo") as "id"'))
				 ->group_by("tblACC_APVHeader.APV_DocNo");

		if(isset($queries['search'])){
			$this->db->group_start();
			$this->db->where(array('LOWER(CAST("APV_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%' ));
			$this->db->or_where(array('LOWER(CAST("APV_SupplierName" as text)) LIKE' => '%'.strtolower($queries['search']).'%' ));
			$this->db->or_where(array('LOWER(CAST("APV_PaymentTerms" as text)) LIKE' => '%'.strtolower($queries['search']).'%' ));
			$this->db->or_where(array('LOWER(CAST("APV_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%' ));
			$this->db->or_where(array('LOWER(CAST("APV_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%' ));
			$this->db->or_where(array('LOWER(CAST("APV_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%' ));
			$this->db->group_end();
		}

		if(isset($where)){
			$this->db->where($where);
		}
		
		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("APV_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("APV_DocDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by(' CASE "APV_Status"
								      WHEN '."'Open'".' THEN 1
								      WHEN '."'Pending'".' THEN 2
								      WHEN '."'Approved'".' THEN 3
								      ELSE 4 
								   END');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_APVHeader",false));
		
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

  // 	public function get_spec_cpc_per_rp($where){

		// $result =	$this->db->select(array('SP_FK_CPC_id'))
	 // 						 ->join('tblINV_StoreProfile','RPH_Location = SP_StoreID','left')
	 // 						 ->where($where)
	 // 						 ->get("tblACC_RPHeader");
	 //    return $result->row_array();
  //   }
    
    public function convert($id,$data){
    	$doc = $this->get_spec_data_row_spec_fields(array("APV_DocNo"),array('MD5("APV_DocNo")' => $id));
    	$doc['APV_DocNo'];
    	foreach ($data as $key => $value) {
    		$this->db->trans_start();
    		$details = array('tblACC_RPDetails' => array('where' => array('RPD_PFK_DocNo' => $value->doc,
    												    				  'RPD_LineNo'	  => $value->line),
    													'data'	 => array('RPD_Status'	  => 'With APV',
    																	 'RPD_RefTo'	  => $doc['APV_DocNo']),
    													'select' => array('"RPD_ItemType" as "APVD_ItemType"',
    																	 '"RPD_ItemNo" as "APVD_ItemNo"', 
    																	 '"RPD_ItemDescription" as "APVD_Description"', 
    																	 '"RPD_Qty" as "APVD_Qty"',
    																	 '"RPD_UnitPrice" as "APVD_UnitPrice"',
    																	 '"RPD_Amount" as "APVD_Amount"',
    																	 '"RPD_AmountLCY" as "APVD_AmountLCY"',
    																	 '"RPD_ExchangeRate" as "APVD_ExchangeRate"',
    																	 '"RPD_CPC" as "APVD_CostCenter"',
    																	 '"RPD_VAT" as "APVD_VAT"',
    																	 '"RPD_WHT" as "APVD_WHT"',
    																	 '"RPD_Comment" as "APVD_Comment"',
    																	 '"RPH_Location" as "APVD_Location"',
    																	 '"RPD_PFK_DocNo" as "APVD_RefFrom"',
    																	 '"RPD_LineNo" as "APVD_RefFromLineNo"',
    																	 "'".$doc['APV_DocNo']."'".' as "APVD_PFK_DocNo"',
    																	 "'".$value->table."'".' as "APVD_TargetTable"',
    																	 '"COM_Currency" as "APVD_BaseCurrency"',
    																	 '"RPH_Currency" as "APVD_Currency"',
    																	 '0 as "APVD_LineDiscPerc"',
    																	 '0 "APVD_LineDiscAmount"',
    																	 )));
			MY_Model::set_table($value->table);
			switch ($value->table) {
				case 'tblACC_RPDetails':			   
						$result = $this->db->select($details[$value->table]['select'])
										   ->where($details[$value->table]['where'])
										   ->join('tblACC_RPHeader','RPD_PFK_DocNo=RPH_DocNo','left')
										   ->join('tblCOM_Company','RPH_Company=COM_Id','left')
										   ->get($value->table)->row_array();

						$this->update_data($details[$value->table]['where'],$details[$value->table]['data']);
				break;
				
				default:
			    		$result = $this->get_spec_data_row_spec_fields($details[$value->table]['select'],$details[$value->table]['where']);
			            $this->update_data($details[$value->table]['where'],$details[$value->table]['data']);
				break;

			}		
            MY_Model::set_table("tblACC_APVDetail");
            $this->add_data($result);
           
        	$this->db->trans_complete();
		}
        
        if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}else{
			return 1;
		}
    }
}
