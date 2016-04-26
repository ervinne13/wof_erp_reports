<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_model
 extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_PO");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("PO_DocNo",
	    						'DATE("PO_DocDate") as "PO_DocDate"',
	    						'PO_SupplierName',
								'PO_ExpectedDeliveryDate',
								'PO_Status',
								'PO_Company',
								'PO_Amount',
								'PO_DateSent',
	    						'md5("PO_DocNo") as "id"'))
				 ->group_by("tblCOM_PO.PO_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("PO_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("PO_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("PO_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PO_SupplierName" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PO_ExpectedDeliveryDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PO_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PO_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PO_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("PO_DateSent" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblCOM_PO.PO_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_PO",false));
		
		if($perPage !=='All'){
			$this->db->limit($perPage,$offset);
		}

		// print_r($this->db->error());
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
 		 					 ->get("tblCOM_PO");

	    return $result->row_array()['count'];
  	}

  	public function update_po($where,$data){
  		
  		$poDetails  = json_decode($data['rqSpec'],true);
  		unset($data['rqSpec']);
  		// print_r($poDetails);
  		// exit();
  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblCOM_PO',$data);

  		$this->db->where(array('md5("POD_PO_DocNo")' => $where['md5("PO_DocNo"::text)']))
  				 ->delete('tblCOM_PODetail');

  		if(count($poDetails) > 0){
	  		foreach ($poDetails as $key => $value) {
	  			$poDetailInsert  = $this->db->select(
							  				array(	' \''.$data["PO_DocNo"].'\' as "POD_PO_DocNo"',
							  						'"RQD_ItemType" as "POD_ItemType"',
													'"RQD_ItemNo" as "POD_ItemNo"',
													'"RQD_ItemDescription" as "POD_ItemDescription"',
													'"RQD_Location" as "POD_Location"',
													'"RQD_Qty" as "POD_Qty"',
													'"RQD_UOM" as "POD_UOM"',
													'"RQD_UnitCost" as "POD_UnitPrice"',
													'("RQD_Qty" * "RQD_UnitCost") as "POD_Total"',
													'"RQD_Currency" as "POD_Currency"',
													'"RQD_Comment" as "POD_Comment"',
													'"RQD_RQ_DocNo" as "POD_RefFrom"',
													'("RQD_UnitCost" * .10) as "POD_EstimatedCost"',
													' \''.$data["PO_VATPostingGroup"].'\' as "POD_VAT"',
													'"IM_WHTProductPostingGroup" as "POD_WHT"',
													'"RQD_Qty" as "POD_QtyToReceive"',
													'"RQD_LineNo" as "POD_RefFromLineNo"'))
	  										->join('tblINV_Item', 'IM_Item_id = RQD_ItemNo','left')
	  										->where(array('md5(concat("RQD_RQ_DocNo","RQD_LineNo"))' => $value['id']))
	  										->get('tblINV_RQDetail');
	  			
	  			if($poDetailInsert->row_array()){
	  				$details = $poDetailInsert->row_array();
	  				
	  				$details['POD_UnitPrice'] 	= isset($value['POD_UnitPrice'])? $value['POD_UnitPrice'] : $details['POD_UnitPrice'];
					$details['POD_Comment'] 	= isset($value['POD_Comment'])? $value['POD_Comment'] : $details['POD_Comment'];
					$details['POD_VAT'] 		= isset($value['POD_VAT'])? $value['POD_VAT'] : $details['POD_VAT'];
					$details['POD_WHT'] 		= isset($value['POD_WHT'])? $value['POD_WHT'] : $details['POD_WHT'];
					$details['POD_Total'] 		= isset($value['POD_UnitPrice'])? $value['POD_UnitPrice'] * $details['POD_Qty'] : $details['POD_Total'];

					$this->db->insert('tblCOM_PODetail',add_data($details));
					$this->db->where(array('md5(concat("RQD_RQ_DocNo","RQD_LineNo"))' => $value['id']))
							 ->update('tblINV_RQDetail',array('RQD_RefTo' => $data["PO_DocNo"],'RQD_RefStatus' => "Open"));
	  			}
	  		}
  		}


		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
        	$this->db->trans_commit();
            return 1;
        }
  	}

}
