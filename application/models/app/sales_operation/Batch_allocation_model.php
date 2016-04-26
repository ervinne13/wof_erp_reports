<?php 

class Batch_allocation_model extends CI_Model{

	private $module_id = 292;
	private $table = "tblINV_BatchAllocation";

	function get_list(){

		$items = $this->db->get('tblINV_BatchAllocation')->result_array();

		return $items;

	}

	function details($docno){

		$this->db->where('BA_DocNo', $docno);
		$item = $this->db->get('tblINV_BatchAllocation')->row_array();

		return $item;
	}

	function detail_list($docno){

		$this->db->where('BAD_BA_DocNo', $docno);
		$this->db->order_by('DateCreated');
		$items = $this->db->get("tblINV_BatchAllocationDetails")->result_array();

		return $items;
	}

	function sub_details($docno, $item_no){

 		$this->db->where('BASD_BAD_BA_DocNo', $docno);
		$this->db->where('BASD_BAD_ItemNo', $item_no);
		$item = $this->db->get('tblINV_BatchAllocationSubDetails')->result_array();

		return $item;

	}

	function detail_item($docno, $item_no){

		$this->db->where('BAD_ItemNo', $item_no);
		$this->db->where('BAD_BA_DocNo', $docno);
		$item = $this->db->get("tblINV_BatchAllocationDetails")->row_array();

		return $item;
	}

	function suppliers(){	

		$this->db->where('S_Active', '1');
		$this->db->order_by('S_Name');
		$items = $this->db->get('tblCOM_Supplier')->result_array();

		return $items;
	}

	function regions(){


		$this->db->where('AD_FK_Code', '260');
		$items = $this->db->get('tblCOM_AttributeDetail')->result_array();

		return $items;

	}

	function save_details($data, $docno = NULL){

		$data['ModifiedBy'] = $this->session->userdata('U_User_id');
		$data['DateModified'] = date('Y-m-d H:i:s');

		if($docno){

			$data['CreatedBy'] = $this->session->userdata('U_User_id');
			$data['DateCreated'] = date('Y-m-d H:i:s');

			$this->db->where('BA_DocNo', $docno);
			$this->db->update('tblINV_BatchAllocation', $data);

		}

	}

	function add($data){

		$data['CreatedBy'] = $this->session->userdata('U_User_id');
		$data['DateCreated'] = date('Y-m-d H:i:s');
		$data['ModifiedBy'] = $this->session->userdata('U_User_id');
		$data['DateModified'] = date('Y-m-d H:i:s');

		$this->db->insert('tblINV_BatchAllocation', $data);

		$this->_getseries(TRUE);

	}

	function item_types(){

		$this->db->select('IT_Id, IT_Description');
		$this->db->where('IT_Active', '1');
		$this->db->order_by('IT_Description');
		$result = $this->db->get('tblINV_ItemType')->result_array();
			
		return $result;
	}

	function items(){

		$this->db->select('IM_Item_id, IM_Sales_Desc, IM_FK_Attribute_UOM_id');
		$this->db->where("IM_Active", '1');
		$this->db->order_by("IM_Sales_Desc");
		$result = $this->db->get('tblINV_Item')->result_array();
		
		return $result;
	}

	function update_details($data, $docno, $itemno){

		$data['ModifiedBy'] = $this->session->userdata('U_User_id');
		$data['DateModified'] = date('Y-m-d H:i:s');

		$this->db->where('BAD_BA_DocNo', $docno);
		$this->db->where('BAD_ItemNo', $itemno);
		$this->db->update('tblINV_BatchAllocationDetails', $data);

	}

	function delete_details($docno, $itemno){
		$this->db->where('BAD_BA_DocNo', $docno);
		$this->db->where('BAD_ItemNo', $itemno);
		$this->db->delete('tblINV_BatchAllocationDetails');
	}

	function save_sub_details($dt, $line_no){

		$this->db->where('BASD_LineNo', $line_no);
		$this->db->update('tblINV_BatchAllocationSubDetails', $dt);
	}

	function empty_details(){

		$item = array();
		$fields = $this->db->list_fields('tblINV_BatchAllocationDetails');

		foreach ($fields as $i => $v) {
			$item[$v] = NULL;
		}

		return $item;

	}

	function empty_header(){

		$item = array();
		$fields = $this->db->list_fields('tblINV_BatchAllocation');

		foreach ($fields as $i => $v) {
			$item[$v] = NULL;
		}

		$item['BA_DocDate'] = date('Y-m-d');
		$item['BA_Status'] = 'Open';
		$item['BA_DocNo'] = $this->_getseries();
		$item['new'] = TRUE;

		return $item;

	}

	function uom(){
		$location = $this->session->userdata('dlocation');

		$query = 'select "IUC_FK_Item_id",  "ad"."AD_Code", "ttp"."TTP_Price", "iuc"."IUC_FK_UOM_id" from "tblINV_ItemUOMConv" as "iuc" 
				inner join "tblCOM_AttributeDetail" as "ad" on "ad"."AD_Id" = "iuc"."IUC_FK_UOM_id"
				inner join "tblINV_TTPAssumptions" as "ttp" on "ttp"."TTP_ItemNo" = "iuc"."IUC_FK_Item_id"
				where "IUC_FK_Item_id" in (select "TTP_ItemNo" from "tblINV_TTPAssumptions") 
				and "TTP_Type" = \'0\' 
				and "TTP_SP_StoreID" = \'' . $location['CA_FK_Location_id'] . '\' 
				and "iuc"."IUC_Quantity" = \'1\'
				order by "iuc"."IUC_Quantity", "ttp"."TTP_Price" asc';

		$result = $this->db->query($query)->row_array();

		return $result;
	}

	function add_details($data){

		$data['CreatedBy'] = $this->session->userdata('U_User_id');
		$data['DateCreated'] = date('Y-m-d H:i:s');
		$data['ModifiedBy'] = $this->session->userdata('U_User_id');
		$data['DateModified'] = date('Y-m-d H:i:s');

		$this->db->insert('tblINV_BatchAllocationDetails', $data);
	}

	function _getseries($generate = FALSE){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->generate_no($this->module_id,$this->table,'BA_DocNo', NULL, $generate);
		if($data['rows'] == 0){
			$dt = array('rows'=>$data['rows']);
		}else if($data['rows'] == 1){
			$dt = array('rows'=>$data['rows'],'data'=> $data['data'][0]['NS_Id'].'-'.$data['data'][0]['nsnum'],'uniqid' => $data['data'][0]['uniq']);
		}else{
			$dt = array('rows'=>$data['rows']);
		}

		return $dt['data'];
	}

	
}