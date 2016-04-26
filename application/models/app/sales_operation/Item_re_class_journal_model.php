<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_re_class_journal_model extends MY_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_IRJ");
    }

  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("IRJ_DocNo",
	    						'DATE("IRJ_DocDate") as "IRJ_DocDate"',
	    						"IRJ_Remarks",
	    						"IRJ_Company",
	    						"IRJ_Location",
	    						"IRJ_Status",
	    						'md5("IRJ_DocNo") as "id"'))
	    		 ->group_start()
	    		 ->where_in('IRJ_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
	    		 ->or_where('IRJ_Location',null)
	    		 ->group_end()
				 ->group_by("tblINV_IRJ.IRJ_DocNo");

		if(isset($queries['date-from'])){
			$this->db->where(array('DATE("IRJ_DocDate") >=' => $queries['date-from']));
		}

		if(isset($queries['date-to'])){
			$this->db->where(array('DATE("IRJ_DocDate") <=' => $queries['date-to']));
		}

		if(isset($queries['search'])){
			$this->db->group_start();
			
			$this->db->where(array(	'LOWER(CAST("IRJ_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("IRJ_Remarks" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("IRJ_Company" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("IRJ_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
			$this->db->or_where(array(	'LOWER(CAST("IRJ_Status" as text)) LIKE' => '%'.strtolower($queries['search']).'%'));
										
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
			$this->db->order_by('tblINV_IRJ.IRJ_DocNo DESC');
		}
			

		$count = $this->db->query($this->db->get_compiled_select("tblINV_IRJ",false));
		
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
					  		 ->where_in('IRJ_Location',array_column($this->session->userdata('location'),'SP_StoreID'))
 		 					 ->or_where('IRJ_Location',null)
 		 					 ->get("tblINV_IRJ");

	    return $result->row_array()['count'];
  	}

  	public function update_IRJ($where,$data){
  		
  		$details  = $data['details'];
  		unset($data['details']);

  		$this->db->trans_begin();

  		$this->db->where($where)
  				 ->update('tblINV_IRJ',$data);
  				 
  		$this->db->where(array('md5("IRJD_IRJ_DocNo")' => $where['md5("IRJ_DocNo"::text)']))
  				 ->delete('tblINV_IRJDetail');

  		if($details){
	  		foreach ($details as $key => $value) {
	  			$empty = !array_filter($value);
				if(!empty($value) && !$empty){
		  			$value['IRJD_IRJ_DocNo'] = $data['IRJ_DocNo'];
		  			$this->db->insert('tblINV_IRJDetail',add_data($value));
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
