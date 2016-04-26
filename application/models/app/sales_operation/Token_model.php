<?php 

class Token_model extends CI_Model{

	private $module_id = 291;
	private $table = "tblINV_FTTI";

	function tokens(){

		$this->db->order_by('FTTI_DateRedeemed', 'desc');
		$tokens = $this->db->get('tblINV_FTTI')->result_array();

		return $tokens;
	}

	function details($docno){

		$this->db->where('FTTI_DocNo', $docno);
		$item = $this->db->get('tblINV_FTTI')->row_array();

		return $item;
	}

	function details_empty(){

		$item = array();
		$fields = $this->db->list_fields('tblINV_FTTI');

		foreach ($fields as $field)
		   $item[$field] = NULL;

		$sess = $this->session->userdata;

		$item['FTTI_DateRedeemed'] = date('m/d/Y');
		$item['FTTI_DocNo'] = $this->_getseries();
		$item['FTTI_Branch'] = $sess['dlocation']['CA_FK_Location_id'];

		return $item;
	}

	function _getseries($generate = FALSE){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->generate_no($this->module_id,$this->table,'RD_DocNo', NULL, $generate);
		if($data['rows'] == 0){
			$dt = array('rows'=>$data['rows']);
		}else if($data['rows'] == 1){
			$dt = array('rows'=>$data['rows'],'data'=> $data['data'][0]['NS_Id'].'-'.$data['data'][0]['nsnum'],'uniqid' => $data['data'][0]['uniq']);
		}else{
			$dt = array('rows'=>$data['rows']);
		}

		return $dt['data'];
	}

	function search_barcode($type, $no, $date_redeemed){

		$item = array();

		if(!empty($type) && !empty($no)){

			$this->db->where('FTTIS_Type', $type);
			$this->db->where('FTTIS_SeriesFrom <=', $no);
			$this->db->where('FTTIS_SeriesTo >=', $no);
			$this->db->where('FTTIS_ExpirationDate >=', $date_redeemed);

			$item = $this->db->get('tblINV_FTTISetup_FGCGRC')->row_array();

			if($item){
				$item['type'] = $type;
				$item['series_no'] = $no;
			}

			$this->db->where('FTTID_SeriesNo', $type . $no);
			$result = $this->db->get('tblINV_FTTIDetail')->result_array();

			if(count($result) > 0){
				$item['exist'] = TRUE;
			}
		}

		return $item;
	}

	function uom($docno = NULL){

		$location = $this->session->userdata('dlocation');

		$query = 'select "IUC_FK_Item_id",  "ad"."AD_Code", "ttp"."TTP_Price", "iuc"."IUC_FK_UOM_id" from "tblINV_ItemUOMConv" as "iuc" 
				inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
				inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
				where "IUC_FK_Item_id" in (select "TTP_ItemNo" from "tblINV_TTPAssumptions") 
				and "TTP_Type" = \'0\' 
				and "TTP_SP_StoreID" = \'' . $location['CA_FK_Location_id'] . '\' 
				and "iuc"."IUC_Quantity" = \'1\'
				order by "iuc"."IUC_Quantity", "ttp"."TTP_Price" asc';

		$items = $this->db->query($query)->result_array();
		$items = $this->uom_details($items, $docno);

		return $items;
	}

	function uom_details($items, $docno){

		$data = array(); 

		if($docno){

			$this->db->join('tblINV_ItemUOMConv', 'tblINV_ItemUOMConv.IUC_FK_UOM_id = tblINV_FTTI_Token.FTO_UOM', 'left');
			$this->db->join('tblCOM_AttributeDetail', 'tblCOM_AttributeDetail.AD_Id = tblINV_FTTI_Token.FTO_UOM', 'left');
			$this->db->where('FTO_FTTI_DocNo', $docno);
			$results = $this->db->get('tblINV_FTTI_Token')->result_array();
		
			foreach ($results as $i => $v) {
			

				$data[$i]['IUC_FK_Item_id'] = $v['IUC_FK_Item_id'];
				$data[$i]['AD_Code'] = $v['AD_Code'];
				$data[$i]['TTP_Price'] = $v['FTO_Price'];
				$data[$i]['IUC_FK_UOM_id'] = $v['FTO_UOM'];
				$data[$i]['qty'] = $v['FTO_Qty'];
				$data[$i]['free'] = $v['FTO_FreeToken'];

			}

		} else{

			$data = $items; 
			foreach ($data as $i => $v) {
				$data[$i]['qty'] = '';
				$data[$i]['free'] = '';
			}

		}

		return $data;
	}

	function serialize($items, $column){

		$data =  array();

		foreach ($items as $i => $v) {
			$data[$v[$column]] = $v;
		}

		return $data;
	}


	function ticket($docno){

		$location = $this->session->userdata('dlocation');

		$query = 'select "IUC_FK_Item_id",  "ad"."AD_Code", "ttp"."TTP_Price", "iuc"."IUC_FK_UOM_id" from "tblINV_ItemUOMConv" as "iuc" 
				inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
				inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
				where "IUC_FK_Item_id" in (select "TTP_ItemNo" from "tblINV_TTPAssumptions") 
				and "TTP_Type" = \'3\' 
				and "TTP_SP_StoreID" = \'' . $location['CA_FK_Location_id'] . '\' 
				and "iuc"."IUC_Quantity" = \'1\'
				order by "iuc"."IUC_Quantity", "ttp"."TTP_Price" asc';

		$items = $this->db->query($query)->result_array(); 
		$items = $this->ticket_details($items, $docno);
		
		return $items;
	}

	function ticket_details($items, $docno){

		$data = array();

		if($docno){


			$this->db->join('tblINV_ItemUOMConv', 'tblINV_ItemUOMConv.IUC_FK_UOM_id = tblINV_FTTI_Ticket.FTI_TicketColor', 'left');
			$this->db->join('tblCOM_AttributeDetail', 'tblCOM_AttributeDetail.AD_Id = tblINV_FTTI_Ticket.FTI_TicketColor', 'left');
			$this->db->where('FTI_FTTI_DocNo', $docno);
			$results = $this->db->get('tblINV_FTTI_Ticket')->result_array();

			foreach ($results as $i => $v) {

				$data[$i]['IUC_FK_Item_id'] = $v['IUC_FK_Item_id'];
				$data[$i]['AD_Code'] = $v['AD_Code'];
				$data[$i]['TTP_Price'] = $v['FTI_Price'];
				$data[$i]['IUC_FK_UOM_id'] = $v['FTI_TicketColor'];
				$data[$i]['from'] = $v['FTI_SeriesFrom'];
				$data[$i]['to'] = $v['FTI_SeriesTo'];

			}
			
		} else{

			$data = $items;

			foreach ($data as $i => $v) {
				$data[$i]['from'] = '';
				$data[$i]['to'] = '';
			}
		}

		return $data;

	}

	function save_header($header){

		$header['CreatedBy'] = $this->session->userdata('U_User_id');
		$header['ModifiedBy'] = $this->session->userdata('U_User_id');
		$header['DateCreated'] = date('Y-m-d H:i:s');
		$header['DateModified'] = date('Y-m-d H:i:s');

		$this->db->insert('tblINV_FTTI', $header);

		$this->_getseries(TRUE);
	}

	function update_header($header, $id){

		$header['ModifiedBy'] = $this->session->userdata('U_User_id');
		$header['DateModified'] = date('Y-m-d H:i:s');

		unset($header['FTTI_DocNo']);

		$this->db->where('FTTI_DocNo', $id);
		$this->db->update('tblINV_FTTI', $header);
	}

	function save_details_batch($details){

		$this->db->insert_batch('tblINV_FTTIDetail', $details);
	}

	function save_token_batch($token){

		$this->db->insert_batch('tblINV_FTTI_Token', $token);
	}

	function save_ticket_batch($token){

		$this->db->insert_batch('tblINV_FTTI_Ticket', $token);
	}

	function delete($docno){

		$this->db->where('FTO_FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTI_Token');

		$this->db->where('FTI_FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTI_Ticket');

		$this->db->where('FTTID_FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTIDetail');

		$this->db->where('FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTI');
	}

	function fgc_details($docno){

		$this->db->where('FTTID_FTTI_DocNo', $docno);
		$items = $this->db->get('tblINV_FTTIDetail')->result_array();

		foreach ($items as $i => $v) {
			$items[$i]['series_no'] = $v['FTTID_SeriesNo'];
			$items[$i]['FTTIS_FaceValue'] = $v['FTTID_FaceValue'];
		}

		return $items;
	}

	function delete_tokens($docno){

		$this->db->where('FTO_FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTI_Token');
	}

	function delete_tickets($docno){

		$this->db->where('FTI_FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTI_Ticket');
	}

	function delete_details($docno){

		$this->db->where('FTTID_FTTI_DocNo', $docno);
		$this->db->delete('tblINV_FTTIDetail');
	}

	function fgc_setup(){

		$items = $this->db->get('tblINV_FTTISetup_FGCGRC')->result_array();
		return $items;
	}

	function fgc_setup_add($data){

		$this->db->empty_table('tblINV_FTTISetup_FGCGRC');

		if($data)
			$this->db->insert_batch('tblINV_FTTISetup_FGCGRC', $data);

	}
	function promo_setup(){

		$items = $this->db->get('tblINV_FTTISetup_PromoVIP')->result_array();
		return $items;
	}

	function promo_setup_add($data){

		$this->db->empty_table('tblINV_FTTISetup_PromoVIP');

		if($data)
			$this->db->insert_batch('tblINV_FTTISetup_PromoVIP', $data);
	}

	function base_token(){

		$location = $this->session->userdata('dlocation');

		$query = 'select "IUC_FK_Item_id",  "ad"."AD_Code" from "tblINV_ItemUOMConv" as "iuc" 
			inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
			inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
			where "TTP_Type" = \'0\' and "TTP_SP_StoreID" = \'' . $location['CA_FK_Location_id'] . '\' and "iuc"."IUC_Quantity" = \'1\'
			order by "iuc"."IUC_Quantity" asc';

		$items = $this->db->query($query)->result_array();

		pre($items);
	}

	function check_promo_code($code){

		$this->db->where('FTTIS_Code', $code);
		$items = $this->db->get('tblINV_FTTISetup_PromoVIP')->result_array();

		return $items ? FALSE : TRUE;
	}

	function promo_types(){

		$this->db->where('FTTIS_Type', 'Promo');
		$items = $this->db->get('tblINV_FTTISetup_PromoVIP')->result_array();

		return $items;
	}

	function vip_types(){
		
		$this->db->where('FTTIS_Type', 'VIP');
		$items = $this->db->get('tblINV_FTTISetup_PromoVIP')->result_array();

		return $items;
	}

	function promo_ticket_value($promo_code){
		$this->db->join('tblINV_ItemUOMConv', 'tblINV_ItemUOMConv.IUC_FK_UOM_id = tblINV_FTTISetup_PromoVIP.FTTIS_UOM', 'left');
		$this->db->join('tblCOM_AttributeDetail', 'tblCOM_AttributeDetail.AD_Id = tblINV_FTTISetup_PromoVIP.FTTIS_UOM', 'left');

		$this->db->where('FTTIS_Code', $promo_code);
		$result = $this->db->get('tblINV_FTTISetup_PromoVIP')->row_array();

		return $result['FTTIS_TicketValue'];
	}

	function promo_code_details($docno = FALSE, $promo_code = FALSE){

		$items = array();
		
		if($promo_code){

			$this->db->join('tblINV_ItemUOMConv', 'tblINV_ItemUOMConv.IUC_FK_UOM_id = tblINV_FTTISetup_PromoVIP.FTTIS_UOM', 'left');
			$this->db->join('tblCOM_AttributeDetail', 'tblCOM_AttributeDetail.AD_Id = tblINV_FTTISetup_PromoVIP.FTTIS_UOM', 'left');

			$this->db->where('FTTIS_Code', $promo_code);
			$set = $this->db->get('tblINV_FTTISetup_PromoVIP')->row_array();
			
			$dt = $this->uom($docno);
			$result = $dt[0];
			
			$query = 'select "IUC_FK_Item_id",  "ad"."AD_Code", "ttp"."TTP_Price" from "tblINV_ItemUOMConv" as "iuc" 
				inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
				inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
				where "IUC_FK_Item_id" in (select "TTP_ItemNo" from "tblINV_TTPAssumptions") 
				and "TTP_Type" = \'0\' and "TTP_SP_StoreID" = \'SMMM\' and "iuc"."IUC_Quantity" = \'1\'
				order by "iuc"."IUC_Quantity", "ttp"."TTP_Price" asc';

			$ttp = $this->db->query($query )->row_array();

			$items[] = array(
				'IUC_FK_Item_id' => $ttp['IUC_FK_Item_id'], 
				'AD_Code' => $result['AD_Code'], 
				'TTP_Price' => $ttp['TTP_Price'], 
				'IUC_FK_UOM_id' => $result['IUC_FK_UOM_id'], 
				'qty' => $set['FTTIS_Token'], 
				'free' => 0
			);

		} else{
			$items = $this->uom($docno);
		}

		return $items;
	}
}