<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class item_re_class_journal_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_IRJDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array('IRJD_ItemType',
								'IRJD_ItemNo',
								'IRJD_ItemDescription',
								'IRJD_Location',
								'IRJD_Qty',
								'IRJD_UOM',
								'md5("IRJD_IRJ_DocNo"||\'-\'||"IRJD_LineNo") as trackid',
								'md5(concat("IRJD_IRJ_DocNo","IRJD_LineNo")) as id'))
				 ->group_by("IRJD_IRJ_DocNo,IRJD_LineNo");
		
		if(isset($id)){
			$this->db->where(array('MD5("IRJD_IRJ_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("IRJD_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IRJD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IRJD_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IRJD_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IRJD_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("IRJD_UOM" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by('tblINV_IRJDetail.DateCreated DESC');
		}
			
		$count = $this->db->query($this->db->get_compiled_select("tblINV_IRJDetail",false));
		
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
  						 ->where(array('MD5("IRJD_IRJ_DocNo")' => $this->id))
	    		 		 ->get("tblINV_IRJDetail");
	    		 		 
	    return $result->row_array()['count'];

   }


}
