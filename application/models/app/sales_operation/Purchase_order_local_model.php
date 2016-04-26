<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_local_model
 extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_POL");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("POL_DocNo",
	    						'DATE("POL_DocDate") as "POL_DocDate"',
	    						'POL_SupplierName',
								'POL_Status',
								'POL_Company',
								'POL_Amount',
								'POL_Location',
								'POL_Remarks',
	    						'md5("POL_DocNo") as "id"'))
				 ->group_by("tblCOM_POL.POL_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("POL_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("POL_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array('LOWER(CAST("POL_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_SupplierName" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_DocDate" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array('LOWER(CAST("POL_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblCOM_POL.POL_DocNo DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblCOM_POL",false));
		
		if($perPage !=='All'){
			$this->db->limit($perPage,$offset);
		}
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
 		 					 ->get("tblCOM_POL");

	    return $result->row_array()['count'];
  	}

  		public function update_pol($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);

  		$this->db->trans_begin();

  		$this->db->where(array('md5("POLD_PO_DocNo")' => $where['md5("POL_DocNo"::text)']))
  				 ->delete('tblCOM_POLDetail');

  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
					$total = array('POL_Amount' => $value['POLD_Total']);
					$this->db->where($where)
  				 		 ->update('tblCOM_POL',array_merge($data,$total));

					$insert = array('POLD_VAT'    		 => $data['POL_VATPostingGroup'],
        							'POLD_WHT' 	  		 => $data['POL_WHTPostingGroup'],
        							'POLD_QtyToReceive'  => $value['POLD_Qty'],
        							'POLD_EstimatedCost' => ($value['POLD_UnitPrice'] ? $value['POLD_UnitPrice']: 0) * 0.10);
		  			$value['POLD_PO_DocNo'] = $data['POL_DocNo'];
		  			$this->db->insert('tblCOM_POLDetail',add_data(array_merge($insert,$value)));
					
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
