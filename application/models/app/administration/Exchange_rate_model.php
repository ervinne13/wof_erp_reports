<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exchange_rate_model extends CI_Model {

  public function __construct()
    {
        parent::__construct();
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("ER_DocumentNo",
	    						'MD5("ER_DocumentNo") as id',
	    						'DATE("ER_DocumentDate") as "ER_DocumentDate"',
	    						"ER_BaseCurrencyRate",
	    						"ER_ConvCurrencyRate",
	    						"ER_DocumentStatus",
	    						"a.AD_Desc as base",
	    						"b.AD_Desc as conv",
	    						"ER_DocumentStatus",
	    						'(CASE WHEN "ER_DocumentStatus" = '."'1'".' THEN '."'Approve'".' WHEN "ER_DocumentStatus" = '."'0'".' THEN '."'Pending'".' END) as "ER_DocumentStatus"',
								'(CASE WHEN "ER_Active" = '."'1'".' THEN '."'Active'".' WHEN "ER_Active" = '."'0'".' THEN '."'Inactive'".' END) as "ER_Active"'))
				 ->join('tblCOM_AttributeDetail as a','a.AD_Id = tblACC_ExchangeRate.ER_FK_BaseCurrency_id','left')
				 ->join('tblCOM_AttributeDetail as b','b.AD_Id = tblACC_ExchangeRate.ER_FK_ConvCurrency_id','left')
				 ->group_by("tblACC_ExchangeRate.ER_DocumentNo,a.AD_Desc,b.AD_Desc");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("ER_DocumentNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("ER_BaseCurrencyRate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("ER_ConvCurrencyRate" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("ER_DocumentStatus" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("a"."AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("b"."AD_Desc" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER((CASE WHEN "ER_DocumentStatus" = '."'1'".' THEN '."'Approve'".' WHEN "ER_DocumentStatus" = '."'0'".' THEN '."'Pending'".' END)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "ER_Active" = '."'1'".' THEN '."'Active'".' WHEN "ER_Active" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
										));
		}

		if(isset($queries['date-from'])){
			$this->db->having(array('date("ER_DocumentDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->having(array('date("ER_DocumentDate") <=' => $queries['date-to']));
		}

		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by("tblACC_ExchangeRate.DateCreated DESC");
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblACC_ExchangeRate",false));
		
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
  
  public function record_count(){
  	$result =	$this->db->select('COUNT(*)')
	    		 		 ->get("tblACC_ExchangeRate");

	    return $result->row_array()['count'];
   }

   public function get_all_data(){

   		$result =	$this->db->select('*')
   							 ->where(array('ER_Active' => '1'))
	    		 			 ->get("tblACC_ExchangeRate");

	    return array('rows' => $result->num_rows(),
	    		 	 'data' => $result->result_array());
  }

  public function get_spec_data($where){

		$result =	$this->db->select(array('ER_DocumentNo',
											'ER_FK_BaseCurrency_id',
											'ER_BaseCurrencyRate',
											'ER_FK_ConvCurrency_id',
											'ER_ConvCurrencyRate',
											"DATE(COALESCE(".'"ER_DocumentDate" :: text'.",'')) as  ".'"ER_DocumentDate"'." "))
	 						 ->where($where)
	 						 ->get("tblACC_ExchangeRate");

	    return $result->row_array();
  }

  public function add_data($data){

  	$this->db->insert('tblACC_ExchangeRate',add_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
	
  public function update_data($where,$data){
	
	$this->db->where($where)
  			 ->update('tblACC_ExchangeRate',update_data($data));

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

  public function delete($where){

  	$this->db->where($where)
  			 ->delete('tblACC_ExchangeRate');

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

}
