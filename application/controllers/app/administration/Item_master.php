<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_master extends CI_Controller {
  
  private $module_id = 26;

  private $table 	 = "tblINV_Item";

  private $sub_error = array();

  public function __construct()
    {
        parent::__construct();
      	
      	if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }

    private function _settings(){

      	$data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');
      	$this->load->vars($data);
      	$page 			= array('header'	=> $this->load->view("templates/header","",true),
							  	'footer'	=> $this->load->view("templates/footer","",true),
							  	'navs'		=> $this->load->view('templates/side-nav',"",true),
							  	'head'		=> $this->load->view("templates/head-nav","",true),
							  );
      	return $page;

    }

    public function getseries_update(){
    	$this->load->model('app/administration/no_series_model');
    	echo json_encode($this->no_series_model->getseries_update($this->module_id));
    }

    public function getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'IM_Item_id');
		if($data['rows'] == 0){
			echo json_encode(array('rows'=>$data['rows']));
		}else if($data['rows'] == 1){
			echo json_encode(array('rows'=>$data['rows'],'data'=> $data['data'][0]['NS_Id'].'-'.$data['data'][0]['nsnum'],'uniqid' => $data['data'][0]['uniq']));
		}else{
			echo json_encode(array('rows'=>$data['rows']));
		}
	}

	public function seriesmodal(){
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id);
		$this->load->view('app/administration/no-series/series',$data);
	}

	public function index()
	{		
		$data['title'] = "Administration: Item Master";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-item-master' => array(
						 										'buttons'			=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'			=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'IM_Item_id'		=> array('label' => 'Item Code'),
																'IM_UPCCode'		=> array('label' => 'UPCode'),
																'IM_Sales_Desc'		=> array('label' => 'Item Description'),
																'IM_UnitCost'		=> array('label' => 'Unit Cost'),
																'IM_Status'			=> array('label' => 'Status'),
																'IM_Active'			=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view("app/administration/item-master/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function data(){
		
		$this->load->model('app/administration/item_master_model');

		$data = $this->item_master_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->item_master_model->record_count());
		}

		echo json_encode($result);

	}


	public function item_ledger()
	{		
		$data['title'] = "Item Ledger Entry";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-item-ledger' => array(					 			
															 	'IL_EntryNo'		 => array('label' => 'Entry No'),
															 	'IL_AccountType'	 => array('label' => 'Account Type'),
															 	'IL_AccountID'		 => array('label' => 'Account ID'),
															 	'IL_AccountName'	 => array('label' => 'Account Name'),
																'IL_DocType'		 => array('label' => 'Doc Type'),			
																'IL_DocNo'			 => array('label' => 'Doc No'),				
																'IL_LineNo'			 => array('label' => 'Line No'),
																'IL_ItemType'		 => array('label' => 'Item Type'),
																'IL_ItemNo'			 => array('label' => 'Item No'),
																'IL_ItemDescription' => array('label' => 'Description'),
																'IL_Qty'			 => array('label' => 'Quantity'),
																'IL_RemQty'			 => array('label' => 'Remaining Quantity'),
																'IL_UnitPrice'		 => array('label' => 'Unit Price'),				
																'IL_Amount'		 	 => array('label' => 'Amount'),				
																'IL_AmountLCY'		 => array('label' => 'Amount LCY'),
																'IL_Location'		 => array('label' => 'Location'),
																'IL_SubLocation'	 => array('label' => 'Sub Location'),
																'IL_UOM'			 => array('label' => 'UOM'),
																'IL_Comment'	     => array('label' => 'Comment'),
																'IL_CPC'			 => array('label' => 'Cost Center'),
																'IL_VAT'			 => array('label' => 'VAT'),
																'IL_WHT'		 	 => array('label' => 'WHT'),
																'IL_PostedBy'		 => array('label' => 'Posted By'),
																'IL_DatePosted'		 => array('label' => 'Date Posted'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view("app/financial-management/item-ledger/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	public function item_ledger_data(){
		
		$this->load->model('app/item_ledger_entry_model');

		$data = $this->item_ledger_entry_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map_ledger'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->item_ledger_entry_model->record_count());
		}

		echo json_encode($result);
		// print_r($this->db->error());
		// exit();


	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Item Master: Add";
      	$this->load->vars($data);
			
		$this->load->model('app/administration/attribute_model');
		$content['uom'] 		= $this->attribute_model->get_spec_attribute_dropdown('33');

		$this->load->model('app/administration/item_type_model');
		$content['type'] 	= $this->item_type_model->get_spec_data_array(array('IT_Description !=' => '1'));
		
		$this->load->model('app/administration/buyer_setup_model');
		$content['buyer'] 	= $this->buyer_setup_model->get_spec_data_array(array('B_Active'=>'1'));

		$this->load->model('app/administration/department_setup_model');
		$content['department'] 	= $this->department_setup_model->get_spec_data_array(array('DEP_Active'=>'1'));

		$this->load->model('app/administration/supplier_model');
		$content['supplier'] 	= $this->supplier_model->get_spec_data_array(array('S_Active'=>'1'));

		// $this->load->model('app/financial_management/VAT_prod_posting_group_model');
		// $content['VAT'] 	= $this->VAT_prod_posting_group_model->get_spec_data_array(array('VPPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_prod_posting_group_model');
		$content['WHT'] 	= $this->WHT_prod_posting_group_model->get_spec_data_array(array('WPPG_Active'=>'1'));

		$this->load->model('app/financial_management/Inventory_posting_group_model');
		$content['INV'] 	= $this->Inventory_posting_group_model->get_spec_data_array(array('IPG_Active'=>'1'));

		$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/item-master/add',$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Item Master: Edit";
      	$this->load->vars($data);

      	$this->load->model('app/administration/attribute_model');
		$content['uom'] 		= $this->attribute_model->get_spec_attribute_dropdown('33');

		$this->load->model('app/administration/item_type_model');
		$content['type'] 	= $this->item_type_model->get_spec_data_array(array('IT_Services !=' => '1'));
		
		$this->load->model('app/administration/buyer_setup_model');
		$content['buyer'] 	= $this->buyer_setup_model->get_spec_data_array(array('B_Active'=>'1'));

		$this->load->model('app/administration/department_setup_model');
		$content['department'] 	= $this->department_setup_model->get_spec_data_array(array('DEP_Active'=>'1'));

		$this->load->model('app/administration/supplier_model');
		$content['supplier'] 	= $this->supplier_model->get_spec_data_array(array('S_Active'=>'1'));

		// $this->load->model('app/financial_management/VAT_prod_posting_group_model');
		// $content['VAT'] 	= $this->VAT_prod_posting_group_model->get_spec_data_array(array('VPPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_prod_posting_group_model');
		$content['WHT'] 	= $this->WHT_prod_posting_group_model->get_spec_data_array(array('WPPG_Active'=>'1'));

		$this->load->model('app/financial_management/Inventory_posting_group_model');
		$content['INV'] 	= $this->Inventory_posting_group_model->get_spec_data_array(array('IPG_Active'=>'1'));

		$this->load->model('app/administration/item_master_model');
		$content['data'] 		=  $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' 	=> $this->input->get('id')));
		
		$this->load->model('app/administration/category_model');
		$content['category'] 	= $this->category_model->get_spec_data_array(array('CAT_FK_ItemType_id' => $content['data']['IM_FK_ItemType_id']));

		$this->load->model('app/administration/sub_category_model');
		$content['subcategory'] = $this->sub_category_model->get_spec_data_array(array('SC_FK_Category_id' => $content['data']['IM_FK_Category_id']));

		$this->load->model('app/administration/identifier_setup_model');
		$identifier = $this->identifier_setup_model->get_all_spec_data_json($content['data']['IM_FK_Category_id'],$content['data']['IM_FK_SubCategory_id']);
		
		$identifier['peritem'] = $this->item_master_model->get_identifiers_per_item(array('IMI_FK_Item_id' 	=> $content['data']['IM_Item_id']));

 		$content['identifiers'] = $this->load->view('app/administration/item-master/identifier',$identifier,true);
						
		$this->load->model('app/administration/item_uom_model');
		$content['sub'] 		=  $this->item_uom_model->get_spec_datas(array("IUC_FK_Item_id" 	=> $content['data']['IM_Item_id']));

		$this->load->model('app/administration/item_supplier_model');
		$content['sup'] 		=  $this->item_supplier_model->get_spec_datas(array("IS_FK_Item_id" 	=> $content['data']['IM_Item_id']));

		$content['functions'] 	= $this->approval_functions($this->input->get('id'));

		if(!empty($content['data'])){
			$content['data']['id']	=  $this->input->get('id');
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/item-master/update',$content,true)));	
			$this->load->view("templates/container", $page);
		}else{
			redirect(site_url()."app/error");
		}
	}

	public function back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($pk, $this->table);

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3));
	}

	
	public function process(){

		$this->load->model('app/administration/item_master_model');

		$point 	 = array(
	                     'field'   => 'IM_Points', 
	                     'label'   => 'Points', 
	                     'rules'   => 'TRIM|integer'
                  		);

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				$this->load->model('app/administration/item_type_model');
				$config = $this->_validation_config('add'); 
				if($this->item_type_model->get_spec_data_row(array('IT_Id' => $this->input->post('IM_FK_ItemType_id')))['IT_PointsRequired'] == 1){
					 $point['rules'] .= '|required';
				}
				array_push($config, $point); 
				if($this->_validate($config)){
					
					$_POST['IM_Active'] = '1';
					
					$this->_set_default();

					$this->item_master_model->add_data($this->input->post(NULL,TRUE));
					
					echo json_encode(array('result' => 1));
					
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				$this->load->model('app/administration/item_type_model');
				$config = $this->_validation_config('update',$id); 
				if($this->item_type_model->get_spec_data_row(array('IT_Id' => $this->input->post('IM_FK_ItemType_id')))['IT_PointsRequired'] == 1){
					 $point['rules'] .= '|required';
				}
				array_push($config, $point); 

				$this->_set_default();
				if($this->_validate($config)){
					unset($_POST['uniqid']);

					$this->load->model('app/administration/item_uom_model');
					$this->load->model('app/administration/item_supplier_model');
					
					$result = $this->item_master_model->get_spec_data_row_spec_fields(array('*','md5("IM_Item_id") as id'),array('md5("IM_DocNo")' 	=> $id));
					$uom = $this->item_uom_model->get_spec_datas(array('md5("IUC_FK_Item_id")' 	=> $result['id']));
					$sup = $this->item_supplier_model->get_spec_datas(array('md5("IS_FK_Item_id")' 	=> $result['id']));
					
					if(!$this->input->post('old')){
						$_POST['old'] = array();
					}
					if(!$this->input->post('old-s')){
						$_POST['old-s'] = array();
					}
					$_POST['delete'] = array_diff(array_column($uom,'IUC_Id'),array_keys($this->input->post('old')));
					$_POST['delete-s'] = array_diff(array_column($sup,'IS_Id'),array_keys($this->input->post('old-s')));
					
					foreach ($this->input->post('delete')as $key => $value) {
						unset($_POST['old'][$value]);
					}

					foreach ($this->input->post('delete-s')as $key => $value) {
						unset($_POST['old-s'][$value]);
					}
					
					$_POST['IM_Active'] 	= '0';
					$_POST['IM_Status'] 	= 'Open';
					$_POST['IM_Updates'] 	=  json_encode(array_diff_assoc($result,$this->input->post(NULL,TRUE)));
					$runningId = explode('-', $result['IM_Item_id']);
					$_POST['IM_Item_id']    = $_POST['IM_FK_Category_id'].'-'.$_POST['IM_FK_SubCategory_id'].'-'.end($runningId);
					$this->item_master_model->update_data(array('md5("IM_DocNo")' => $id),update_data($this->input->post(NULL,TRUE)));

					$this->load->model('app/administration/user_record_lock_model');
					$this->user_record_lock_model->record_unlock($id, $this->table);
					
					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'activate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->item_master_model->update_data(array('md5("IM_DocNo")' => $value),update_data(array('IM_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->item_master_model->update_data(array('md5("IM_DocNo")' => $value),update_data(array('IM_Active' => '0')));

				}
			break;
			case 'delete_row':
				unset($_POST['type']);
				$this->load->model('app/administration/pack_items_model');
				echo $this->pack_items_model->delete($this->input->post(NULL,TRUE));

			break;
			case 'delete':
				
				echo  $this->item_master_model->delete(array('md5("IM_DocNo")' => $this->input->post('id')));

			break;
			case 'send-approval-request':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

					$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));

					$data = array('DT_DocNo' 		=> $result['IM_DocNo'],
								  'DT_FK_NSCode' 	=> explode('-', $result['IM_DocNo'])[0],
								  'DT_Location' 	=> '',
								  'DT_DocDate'  	=> $result['DateCreated'],
								  'DT_TargetURL' 	=> base_url().'app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/update?id='.$id 
								 );
					
					$this->load->model('app/document_approval_model');
					if($this->document_approval_model->send_approval($data,NULL)){
						
						if($this->item_master_model->update_status(array('md5("IM_DocNo"::text)' => $id),update_data(array('IM_Status' => 'Pending')))){
							echo json_encode(array('status'=>1,'message'=>$this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id))['IM_Status']));
						}else{
							echo json_encode(array('status'=>0));
						}
					
					}else{
						echo json_encode(array('status'=>0,'message'=>'Set up approvers!'));
					}
			break;
			case 'approve':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->approve($result['IM_DocNo'],$this->table,'IM_DocNo','IM_Status')){
					$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));
					if($result['IM_Status'] == 'Approved'){
						$this->item_master_model->update_status(array('md5("IM_DocNo")' => $id),array('IM_Active'=>'1','IM_Updates' => '[]'));
					}
					echo json_encode(array('status'=>1,'message'=>$result['IM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel($result['IM_DocNo'],$this->table,'IM_Status','IM_DocNo','tblACC_RPDetails','RPD_PFK_DocNo')){
					echo 1;
				}else{
					echo 0;
				}
			break;
			case 'reject':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->reject($result['IM_DocNo'],$this->table,'IM_DocNo','IM_Status',$this->input->post('DT_Remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id))['IM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel-approval':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel_approval($result['IM_DocNo'],$this->table,'IM_DocNo','IM_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id))['IM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}

			break;
			case 're-open':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->re_open($result['IM_DocNo'],$this->table,'IM_DocNo','IM_Status',$this->input->post('remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->item_master_model->get_spec_data_row(array('md5("IM_DocNo")' => $id))['IM_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'IM_DocNo','IM_Active');
				$this->load->model('app/administration/user_record_lock_model');
				$this->user_record_lock_model->record_unlock($data['id'], $this->table);
				
				if($data){
					echo json_encode(array('result' => 1,'data'=>$data['NS_Id'].'-'.$data['NS_LastNoUsed'],'uniqid'=>$data['id']));
				}else{
					echo json_encode(array('result' => 0));
				}
				
			break;
		}
	}

	

	public function search_items(){

		$this->load->model('app/administration/item_master_model');
		$result = $this->item_master_model->search($this->input->get(NULL,TRUE));

		echo json_encode($result);

	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'IM_Item_id', 
			                     'label'   => 'Item Code', 
			                     'rules'   => 'TRIM|required|is_unique[tblINV_Item.IM_Item_id]'
			                  ),
			                // array(
			                //      'field'   => 'IM_Short_Desc', 
			                //      'label'   => 'Short Description', 
			                //      'rules'   => 'TRIM|max_length[25]'
			                //   ),
			                array(
			                     'field'   => 'IM_UPCCode', 
			                     'label'   => 'UPCode', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'IM_Sales_Desc', 
			                     'label'   => 'Sales Description', 
			                     'rules'   => 'TRIM|required|max_length[200]'
			                  ),
			                // array(
			                //      'field'   => 'IM_Purchased_Desc', 
			                //      'label'   => 'Purchase Description', 
			                //      'rules'   => 'TRIM|max_length[200]'
			                //   ),
			                array(
			                     'field'   => 'IM_CostOfGoods', 
			                     'label'   => 'Cost of Goods', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                array(
			                     'field'   => 'IM_UnitCost', 
			                     'label'   => 'Unit Cost (Php)', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                
			                // array(
			                //      'field'   => 'IM_VATProductPostingGroup', 
			                //      'label'   => 'VAT Posting Group', 
			                //      'rules'   => 'TRIM|max_length[30]'
			                //   ),
			                array(
			                     'field'   => 'IM_INVPosting_Group', 
			                     'label'   => 'Inventory Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                 array(
			                     'field'   => 'IM_WHTPosting_Group', 
			                     'label'   => 'WHT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                   array(
			                     'field'   => 'IM_FK_Category_id', 
			                     'label'   => 'Category', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                   array(
			                     'field'   => 'IM_FK_SubCategory_id', 
			                     'label'   => 'Sub Category', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                   array(
			                     'field'   => 'IM_FK_ItemType_id', 
			                     'label'   => 'Type', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ), 
			                   array(
			                     'field'   => 'IM_FK_Attribute_UOM_id', 
			                     'label'   => 'UOM', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),  
			                  array(
			                     'field'   => 'IM_FK_BuyerClass_id', 
			                     'label'   => 'Buyer', 
			                     'rules'   => 'TRIM|required'
			                  ),		
			                   array(
			                     'field'   => 'IM_UnitCost', 
			                     'label'   => 'Last PO Cost', 
			                     'rules'   => 'TRIM|numeric'
			                  )				                  
                		),
			'update'	=> array(
								array(
				                     'field'   => 'IM_Item_id', 
				                     'label'   => 'Item Code', 
				                     'rules'   => 'TRIM|required|is_unique2[tblINV_Item.IM_Item_id.IM_Item_id.'.$this->input->post('IM_Item_id').']'
				                 ),
								// array(
			     //                 'field'   => 'IM_Short_Desc', 
			     //                 'label'   => 'Short Description', 
			     //                 'rules'   => 'TRIM|max_length[25]'
			     //              	),
			                  	array(
			                     'field'   => 'IM_UPCCode', 
			                     'label'   => 'UPCode', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'IM_Sales_Desc', 
			                     'label'   => 'Sales Description', 
			                     'rules'   => 'TRIM|required|max_length[200]'
			                  ),
			                // array(
			                //      'field'   => 'IM_Purchased_Desc', 
			                //      'label'   => 'Purchase Description', 
			                //      'rules'   => 'TRIM|max_length[200]'
			                //   ),
			                array(
			                     'field'   => 'IM_CostOfGoods', 
			                     'label'   => 'Cost of Goods', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			                array(
			                     'field'   => 'IM_UnitCost', 
			                     'label'   => 'Unit Cost (Php)', 
			                     'rules'   => 'TRIM|numeric'
			                  ),
			              
			                // array(
			                //      'field'   => 'IM_VATProductPostingGroup', 
			                //      'label'   => 'VAT Posting Group', 
			                //      'rules'   => 'TRIM|max_length[30]'
			                //   ),
			                array(
			                     'field'   => 'IM_INVPosting_Group', 
			                     'label'   => 'Inventory Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                 array(
			                     'field'   => 'IM_WHTPosting_Group', 
			                     'label'   => 'WHT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                   array(
			                     'field'   => 'IM_FK_Category_id', 
			                     'label'   => 'Category', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                   array(
			                     'field'   => 'IM_FK_SubCategory_id', 
			                     'label'   => 'Category', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                   array(
			                     'field'   => 'IM_FK_ItemType_id', 
			                     'label'   => 'Type', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ), 
			                   array(
			                     'field'   => 'IM_FK_Attribute_UOM_id', 
			                     'label'   => 'UOM', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  ),
			                  array(
			                     'field'   => 'IM_FK_BuyerClass_id', 
			                     'label'   => 'Buyer', 
			                     'rules'   => 'TRIM|required'
			                  ),		
			                   array(
			                     'field'   => 'IM_UnitCost', 
			                     'label'   => 'Last PO Cost', 
			                     'rules'   => 'TRIM|numeric'
			                  )				             
						),
			
            );
					// print_r($this->input->post('pack'));
					// exit();
			if($this->input->post('uom')){

				foreach ($this->input->post('uom') as $key => $value) {
					  array_push($config[$type], 
					  						array(
					  							'field'   => 'uom[' . $key . '][IUC_FK_UOM_id]', 
							                    'label'   => 'UOM', 
							                    'rules'   => 'TRIM|required'
					  						),
						  					array(
						  						'field'   => 'uom[' . $key . '][IUC_Quantity]', 
							                    'label'   => 'Quantity', 
							                    'rules'   => 'TRIM|required|numeric'
						  					)
					  			);
				}
			}

			if($this->input->post('old')){

				foreach ($this->input->post('old') as $key => $value) {
					  array_push($config[$type], 
					  						array(
					  							'field'   => 'old[' . $key . '][IUC_FK_UOM_id]', 
							                    'label'   => 'UOM', 
							                    'rules'   => 'TRIM|required'
					  						),
						  					array(
						  						'field'   => 'old[' . $key . '][IUC_Quantity]', 
							                    'label'   => 'Quantity', 
							                    'rules'   => 'TRIM|required|numeric'
						  					)
					  			);
				}
			}

			if($this->input->post('old-s')){

				foreach ($this->input->post('old-s') as $key => $value) {
					  array_push($config[$type], 
					  						array(
					  							'field'   => 'old-s[' . $key . '][IS_FK_Suppllier_id]', 
							                    'label'   => 'Supplier', 
							                    'rules'   => 'TRIM|required'
					  						),
						  					array(
						  						'field'   => 'old-s[' . $key . '][IS_SupplierItemCode]', 
							                    'label'   => 'Supplier Code', 
							                    'rules'   => 'TRIM|max_length[30]'
						  					),
						  					array(
						  						'field'   => 'old-s[' . $key . '][IS_OldItemCode]', 
							                    'label'   => 'Old Item Code', 
							                    'rules'   => 'TRIM|max_length[30]'
						  					)
					  			);
				}
			}

			if($this->input->post('supplier')){

				foreach ($this->input->post('supplier') as $key => $value) {
					  array_push($config[$type], 
					  						array(
					  							'field'   => 'supplier[' . $key . '][IS_FK_Suppllier_id]', 
							                    'label'   => 'Supplier', 
							                    'rules'   => 'TRIM|required'
					  						),
						  					array(
						  						'field'   => 'supplier[' . $key . '][IS_SupplierItemCode]', 
							                    'label'   => 'Supplier Code', 
							                    'rules'   => 'TRIM|max_length[30]'
						  					),
						  					array(
						  						'field'   => 'supplier[' . $key . '][IS_OldItemCode]', 
							                    'label'   => 'Old Item Code', 
							                    'rules'   => 'TRIM|max_length[30]'
						  					)
					  			);
				}
			}


		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					'IM_FK_Attribute_UOM_id'	=> 'null',
					'IM_UnitCost'				=> 'numeric',
					'IM_CostOfGoods'			=> 'numeric',
					'IM_Points'					=> 'integer',
					'IM_FK_Category_id'			=> 'null',
					'IM_FK_ItemType_id'			=> 'null',
					'IM_FK_SubCategory_id'		=> 'null',
					'IM_FK_Department_id'		=> 'null',
					'IM_FK_BuyerClass_id'		=> 'null',
					'IM_FK_Supplier_id'			=> 'null',
					'IM_INVPosting_Group'		=> 'null',
					// 'IM_VATProductPostingGroup'	=> 'null',
					'IM_WHTProductPostingGroup'	=> 'null'
					);
		$this->load->library('set_default');
		$this->set_default->set_config($config);
		$this->set_default->run();
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	

	private function _map_ledger(&$value){
		
		
		foreach ($value AS $key => $item) {
            if ($item === null) {
                $value[$key] = '';

		return $value;
	}}

	}
	
	private function _checkbox($id=""){
		return '<input type="checkbox" class="doc" id="'.$id.'" />';
	}


	private function _map(&$value){
		
		$value['checkbox']  = $value['IM_Status'] == 'Approved' ? $this->_checkbox($value['id']):'';
		$value['buttons'] 	= $this->_access_inline($value['id']);
		$value['IM_UnitCost'] = numeric($value['IM_UnitCost']);

		remove_null_in_array($value);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
	}

	private function approval_functions($id){

		$this->load->model('app/administration/item_master_model');
		$this->load->model('app/transaction_module_functions');

		$result = $this->item_master_model->get_spec_data_row_spec_fields(array('IM_DocNo'),array('md5("IM_DocNo")' => $id));

		$function['functions'] = $this->transaction_module_functions->get_module_functions($this->table,$result['IM_DocNo'],'IM_DocNo','IM_Status','CreatedBy',$this->module_id);
		
		$function['functions']['item']	= 'Item Ledger';

		$function['id']		   = $id;
		
		return $this->load->view("templates/approval_functions",$function,true);

	}

	private function _map_access(&$value){
        
        if($value['UA_AccessName'] == 'Edit'){

        $url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:FALSE;
        $newAccess = explode('/',$url);
        $newAccess = $newAccess[5].'/'.$newAccess[6];
        $value['UA_Trigger']  = $url!==FALSE ? $newAccess.'/update':$this->uri->segment(2).'/'.$this->uri->segment(3).'/update';
            
        }

        if($value['UA_AccessName'] == 'View'){

        $url = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:FALSE;
        $newAccess = explode('/',$url);
        $newAccess = $newAccess[5].'/'.$newAccess[6];
        $value['UA_Trigger']  = $url!==FALSE ? $newAccess.'/view':$this->uri->segment(2).'/'.$this->uri->segment(3).'/view';
            
        }

        if($value['UA_AccessName'] == 'Add'){
            
            $value['UA_Trigger']  = $this->uri->segment(2).'/'.$this->uri->segment(3).'/add';
            
        }


        return $value;
    }

    private function _access_inline($id=""){

        $this->load->model('app/administration/user_profile_model');

        $access = $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'   => $this->module_id));
        $access = $dataresult  = array_map(array($this, '_map_access'), $access);
    

        return  $this->load->view("templates/access_inline",array('id'      => $id,
                                                                  'access'  => $access),true);
    }

    private function _access_header($id=""){

        $this->load->model('app/administration/user_profile_model');
        $access = $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'   => $this->module_id));
        $access = $dataresult  = array_map(array($this, '_map_access'), $access);

        return  $this->load->view("templates/access_inline",array('access' => $access),true);

    }
	
}
