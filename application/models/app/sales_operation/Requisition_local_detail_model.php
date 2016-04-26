<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requisition_local_detail_model extends MY_Model {
  
  private $id = NULL;

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblINV_RQLDetail");
    }

   public function table_data($data){

		extract($data);

	    $this->db->select(array('RQLD_RQ_DocNo',
                    'RQLD_ItemType',
                    'RQLD_ItemNo',
                    'RQLD_ItemDescription',
                    'RQLD_Location',
                    'RQLD_Qty',
                    'RQLD_UOM',
                    'RQLD_UnitCost',
                    'RQLD_Amount',
                    'RQLD_Comment',
                    'RQLD_RefDocNo',
                    'RQLD_RefFrom',
                    'RQLD_RefTo',
                    'RQLD_RefStatus',
                    'RQLD_Status',
                    'RQLD_LineNo',
                    'md5("RQLD_RQ_DocNo"||\'-\'||"RQLD_LineNo") as trackid',
                    'md5(concat("RQLD_RQ_DocNo","RQLD_LineNo")) as id'))
                ->join('tblINV_ItemType', 'IT_Id = RQLD_ItemType', 'left')
                ->join('tblCOM_PODetail', 'POD_RefFrom = RQLD_RQ_DocNo AND POD_RefFromLineNo	 = RQLD_LineNo', 'left')
                ->group_by("RQLD_RQ_DocNo,RQLD_LineNo,IT_Id");

		
		if(isset($id)){
			$this->db->where(array('MD5("RQLD_RQ_DocNo")'=>$id));
			$this->id = $id;
		}

		if(isset($where)){
			$this->db->where($where);
		}


		 if (isset($queries['statusFilter'])) {
            $this->db->where(array('LOWER(CAST("RQLD_Status" as text)) LIKE' => '%' . strtolower($queries['statusFilter']) . '%'));
        }


		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("RQLD_RQ_DocNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_ItemType" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_ItemNo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_ItemDescription" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_Location" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_Qty" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_UOM" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_UnitCost" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_Amount" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_Comment" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_RefTo" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("RQLD_RefStatus" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										));
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}

        else{
            $this->db->order_by(' CASE "RQLD_Status"
                                      WHEN '."'Open'".' THEN 1
                                      WHEN '."'Pending'".' THEN 2
                                      WHEN '."'Approved'".' THEN 3
                                      ELSE 4 
                                   END');
        }
  //       else{
		// 	$this->db->order_by('tblINV_RQLDetail.DateCreated DESC');
		// }
			
		$count = $this->db->query($this->db->get_compiled_select("tblINV_RQLDetail",false));
		
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());

		// $result = $this->db->get("tblCOM_Module");
		// print_r($this->db->error());
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
  						  ->where(array('MD5("RQLD_RQ_DocNo")'=>$this->id))
	    		 		 ->get("tblINV_RQLDetail");
	    		 		 
	    return $result->row_array()['count'];
   }

   public function getPending($id){

   		$result = $this->db->select(array(			'"RQLD_ItemType" as "POD_ItemType"',
													'"RQLD_ItemNo" as "POD_ItemNo"',
													'"RQLD_ItemDescription" as "POD_ItemDescription"',
													'"RQLD_Location" as "POD_Location"',
													'"RQLD_Qty" as "POD_Qty"',
													'"RQLD_UOM" as "POD_UOM"',
													'"RQLD_UnitCost" as "POD_UnitPrice"',
													'("RQLD_Qty" * "RQLD_UnitCost") as "POD_Total"',
													'"RQLD_Currency" as "POD_Currency"',
													'"RQLD_Comment" as "POD_Comment"',
													'"RQLD_RQ_DocNo" as "POD_RefFrom"',
													'("RQLD_Qty" * "RQLD_UnitCost" * .10) as "POD_EstimatedCost"',
													'"IM_VATProductPostingGroup" as "POD_VAT"',
													'"IM_WHTProductPostingGroup" as "POD_WHT"',
													'"RQLD_Qty" as "POD_QtyToReceive"',
													'"RQLD_LineNo" as "POD_RefFromLineNo"',
													'md5(concat("RQLD_RQ_DocNo","RQLD_LineNo")) as id'))
	  										->join('tblINV_Item', 'IM_Item_id = RQLD_ItemNo','left')
	  										->where_in('md5(concat("RQLD_RQ_DocNo","RQLD_LineNo"))',json_decode($id,true))
	  										->get('tblINV_RQDetail');
	    return $result->result_array();
   }

   public function getTOPending($data) {

        extract($data);

        $this->db->select(array(
            '"RQLD_RQ_DocNo"',
            '"RQLD_ItemType"',
            '"RQLD_ItemNo"',
            '"RQLD_ItemDescription"',
            '"RQLD_Location"',
            '"RQLD_Qty"',
            '"RQLD_UOM"',
            '"RQLD_Comment"',
            '"RQLD_RefFrom"',
            'md5(concat("RQLD_RQ_DocNo","RQLD_LineNo")) as id'));
        $this->db->join('tblINV_Item', 'IM_Item_id = RQLD_ItemNo', 'left');
        $this->db->where(array(
        	"RQLD_Status" => "Approved",
            "IM_ForTO"   => "1"
        ));

        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("DateCreated") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("DateCreated") <=' => $queries['date-to']));
        }

        if (isset($queries['location'])) {
            $this->db->where(array('RQLD_Location' => $queries['location']));
        }

        if (isset($queries['company'])) {
//            $this->db->where(array('RQLD_Location' => $queries['company']));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("RQLD_RQ_DocNo" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_ItemType" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_ItemNo" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_ItemDescription" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_Location" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_Qty" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_UOM" as text)) LIKE'             => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("RQLD_Comment" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
           		'LOWER(CAST("RQLD_RefFrom" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }
        $result = $this->db->get("tblINV_RQLDetail");

        // print_r($this->db->error());
        // exit();

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $result->num_rows(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

}
