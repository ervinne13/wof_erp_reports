<?php 

class Redemption_model extends CI_Model{

	function coupon($doc_no){

		$this->db->where('RD_DocNo', $doc_no);
		$coupon = $this->db->get('tblINV_Redemption')->row_array();

		return $coupon;

	}

	function coupon_list($doc_no = NULL){

		if($doc_no)
			$this->db->where('redemption.RD_DocNo', $doc_no);

		$this->db->join('tblINV_RedemptionDetail details', 'details.RDD_RD_DocNo = redemption.RD_DocNo', 'left');
		
		$coupons = $this->db->get('tblINV_Redemption redemption')->result_array();

		return $coupons;
	}

	function transactions(){

		$items = $this->db->get('tblINV_Redemption redemption')->result_array();

		return $items;
	}

	function search_old($desc, $quantity, $item_codes){

		if($quantity)
			$this->db->where('IM_Points <=', $quantity);

		if($item_codes)
			$this->db->where_not_in('IM_Item_id', $item_codes);
	
		$this->db->like('lower("IM_Sales_Desc")', strtolower($desc));
		$items = $this->db->get('"tblINV_Item"')->result_array();

		return $items;
	}

	function search($desc, $quantity, $item_codes){
		
		$query = 'select * from "tblINV_Item"
				where "IM_FK_ItemType_id" = \'RD\' and
				"IM_Points" <= \'' . $quantity . '\'';

		if(!empty($desc))
			$this->db->like('lower("IM_Sales_Desc")', strtolower($desc));

		$this->db->where('IM_FK_ItemType_id', 'RD');	
		$this->db->where('IM_Points <=', $quantity);
		$items = $this->db->get("tblINV_Item")->result_array();

		// $items = $this->db->query($query)->result_array();

		return $items;
	}

	function ticket($item_code){
		$this->db->where('IM_Item_id', $item_code);
		$ticket = $this->db->get('tblINV_Item')->row_array();

		return $ticket;
	}

	function insert_redemption($data){

		$this->db->insert('tblINV_Redemption', $data);
	}

	function insert_details($data){

		$this->db->insert('tblINV_RedemptionDetail', $data);
	}

	function is_item($doc_no){

		$this->db->where('RD_DocNo', $doc_no);
		$items = $this->db->get('tblINV_Redemption')->result_array();

		return count($items) > 0 ? TRUE : FALSE;


	}

	function delet_lp($doc_no, $item_code){

		$this->db->where('RDD_RD_DocNo', $doc_no);
		$this->db->where('RDD_ItemNo', $item_code);
		$this->db->delete('tblINV_RedemptionDetail');
		
	}

	function void_tickets($doc_nos){

		$info['RDD_Qty'] = 0;
		$this->db->where_in('RDD_RD_DocNo', $doc_nos);
		$this->db->update('tblINV_RedemptionDetail', $info);

		$dt['RD_Status'] = 'Void';
		$this->db->where_in('RD_DocNo', $doc_nos);
		$this->db->update('tblINV_Redemption', $dt);

	}

	function items(){

		$location = $this->session->userdata('dlocation');

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('RD_Location', $location['CA_FK_Location_id']);
		$items = $this->db->get('tblINV_Redemption')->result_array();

		return $items;
	}

	function search_void($doc_no){
		$this->db->like('lower("RD_DocNo")', strtolower($doc_no));
		$items = $this->db->get('tblINV_Redemption')->result_array();

		return $items;
	}

	function delete_low_point($item_no, $doc_no){

		$this->db->where('RDD_RD_DocNo', $doc_no);
		$this->db->where('RDD_ItemNo', $item_no);
		$this->db->delete('tblINV_RedemptionDetail');

	}

	function approval(){


		return true;

	}

	function update_redemption($dt, $docno){

		$this->db->where('RD_DocNo', $docno);
		$this->db->update('tblINV_Redemption', $dt);
	}

	function get_low_point(){

		$this->db->select('tblINV_RedemptionDetail.*');
		$this->db->where('RD_Status', NULL);
		// $this->db->join('tblINV_Item', 'tblINV_Item.IM_Item_id = tblINV_RedemptionDetail.RDD_ItemNo', 'left');
		$this->db->join('tblINV_RedemptionDetail', 'tblINV_RedemptionDetail.RDD_RD_DocNo = tblINV_Redemption.RD_DocNo', 'left');
		$items = $this->db->get('tblINV_Redemption')->result_array();

		foreach ($items as $i => $v) {
			
			$this->db->where('IM_Item_id', $v['RDD_ItemNo']);
			$item = $this->db->get('tblINV_Item')->row_array();

			$items[$i]['IM_Sales_Desc'] = $item['IM_Sales_Desc'];

		}

		return $items;
	}
}