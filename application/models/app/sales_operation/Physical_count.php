<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Physical_Count extends CI_Controller{

  private $module_id = 108;
  
  private $table 	 = "tblINV_PCount";

  private $module 	 = "Physical Count";

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
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'PC_DocNo');

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
		$data['title'] = "Store Operation: ".$this->module;
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-physical-count' => array(
						 										'buttons'			=> array('label' => $this->_access_header(),'sorts' => true),
																'PC_DocNo'			=> array('label' => 'Doc. No.'),
															 	'PC_DocDate'		=> array('label' => 'Doc. Date'),
																'PC_Description'	=> array('label' => 'Description'),
																'PC_CountDate'		=> array('label' => 'Count Date'),
																'PC_Status'		    => array('label' => 'Status'),
																)
						 					),
						);

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/sales_operation/physical_count_model');

		$data = $this->physical_count_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->physical_count_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){
		
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Store Operation: ".$this->module.": Add";
      	$this->load->vars($data);
				
		$this->load->model('app/administration/store_profile_model');
        $content['locat'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'),
                                                                            array(array('table' => 'tblINV_Location' , 'connector' => 'SP_FK_LocationType_id = LOC_FK_Type_id')));

        $this->load->model('app/administration/location_model');
        $content['locStructure'] = $this->location_model->get_spec_data_array(array('LOC_Active'=>'1')); 

        $this->load->model('app/administration/item_type_model');
		$content['itemtype'] 	= $this->item_type_model->get_spec_item_array(array('IT_Active' => '1','ITS_FK_Module_id' => $this->module_id),
																			  array(array('table' => 'tblINV_ItemTypeSetup','connector' => 'ITS_FK_ItemType_id = IT_Id')
																				   ));			
		$this->load->model('app/administration/item_master_model');
        $content['item'] = $this->item_master_model->get_spec_data_array(array('IM_Active' => '1'),
                                                                         array(array('table' => 'tblCOM_AttributeDetail' , 'connector' => 'AD_Id = IM_FK_Attribute_UOM_id')));	

		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update(){
		
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Store Operation: ".$this->module.": Edit";
      	$this->load->vars($data);

		$this->load->model('app/administration/store_profile_model');
        $content['locat'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'),
                                                                            array(array('table' => 'tblINV_Location' , 'connector' => 'SP_FK_LocationType_id = LOC_FK_Type_id')));

        $this->load->model('app/administration/location_model');
        $content['locStructure'] = $this->location_model->get_spec_data_array(array('LOC_Active'=>'1')); 

        $this->load->model('app/administration/item_type_model');
		$content['itemtype'] = $this->item_type_model->get_spec_item_array(array('IT_Active' => '1','ITS_FK_Module_id' => $this->module_id),
																			  array(array('table' => 'tblINV_ItemTypeSetup','connector' => 'ITS_FK_ItemType_id = IT_Id')
																				   ));	
		$this->load->model('app/administration/item_type_model');
		$content['itemtypes'] = $this->item_type_model->get_spec_data_array(array('IT_Active' => '1','ITS_FK_Module_id' => $this->module_id),
																			  array(array('table' => 'tblINV_ItemTypeSetup','connector' => 'ITS_FK_ItemType_id = IT_Id')
																				   ));	
		$this->load->model('app/administration/item_master_model');
        $content['item'] = $this->item_master_model->get_spec_data_array(array('IM_Active' => '1'),
                                                                         array(array('table' => 'tblCOM_AttributeDetail' , 'connector' => 'AD_Id = IM_FK_Attribute_UOM_id')));					
		$this->load->model('app/sales_operation/physical_count_model');
		$content['data']	= $this->physical_count_model->get_spec_data_row_spec_fields(array('*','DATE("PC_DocDate") as "PC_DocDate"'),array('md5("PC_DocNo")' => $this->input->get('id')));

		$this->load->model('app/sales_operation/physical_count_detail_model');
		$content['itm'] 	=  $this->physical_count_detail_model->get_spec_datas(array("PCS_PC_DocNo" 	=> $content['data']['PC_DocNo']));

		$this->load->model('app/sales_operation/physical_count_detail_model');
		$content['loc'] 	=  $this->physical_count_detail_model->get_spec_datas(array("PCS_PC_DocNo" 	=> $content['data']['PC_DocNo']));		
	
		$this->load->model('app/sales_operation/physical_count_detail_model');
		$rawDetails	= $this->physical_count_detail_model->get_spec_data_array_spec_fields(											
											array(	'md5("PCS_CS_CountSheetNo"::text) as id',//'to_char("RQD_Date", \'mm/dd/yyyy\') as "RQD_Date" ',
													'PCS_CS_CountSheetNo',
													'PCS_PC_DocNo',
													'PCS_ItemType',
													'PCS_SubLocation',										
												 ),
											array('md5("PCS_PC_DocNo")' => $this->input->get('id'))
											);
		$content['details'] = array();
		//array on fields
		foreach ($rawDetails["data"] AS $detail) {
			if (array_key_exists($detail["PCS_CS_CountSheetNo"], $content['details'])) {
				array_push($content['details'][$detail['PCS_CS_CountSheetNo']]["PCS_ItemType"], $detail["PCS_ItemType"]);
				array_push($content['details'][$detail['PCS_CS_CountSheetNo']]["PCS_SubLocation"], $detail["PCS_SubLocation"]);
			} else {
				$content['details'][$detail['PCS_CS_CountSheetNo']] = array(
					"PCS_CS_CountSheetNo"=> $detail["PCS_CS_CountSheetNo"],
					"PCS_ItemType" 		 => array($detail["PCS_ItemType"]),
					"PCS_PC_DocNo" 		 => $detail["PCS_PC_DocNo"],
					"PCS_SubLocation" 	 => array($detail["PCS_SubLocation"])
				);
			}
		}	
		
		// if(!empty($content['data'])){
			$content['data']['id']	= $this->input->get('id');

			$page = array_merge($this->_settings(),array('content'=> $this->load->view('app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/update',$content,true)));	
			$this->load->view("templates/container", $page);
		// }else{
		// 	redirect(site_url()."app/error");
		// }
	}

	public function approval_functions($id){

		$this->load->model('app/sales_operation/physical_count_model');
		$this->load->model('app/transaction_module_functions');

		$result = $this->physical_count_model->get_spec_data_row_spec_fields(array('PC_DocNo'),array('md5("PC_DocNo")' => $id));
		
		$function['functions'] = $this->transaction_module_functions->get_module_functions($this->table,$result['PC_DocNo'],'PC_DocNo','PC_Status','CreatedBy',$this->module_id);
		
		$function['id']		   = $id;
		
		return $this->load->view("templates/approval_functions",$function,true);

	}
	
	public function view($view=""){

					$data['title'] = "Store Operation: ".$this->module.": View";
			      	$this->load->vars($data);

			      	$this->load->model('app/transaction_module_functions');
			      	$this->load->model('app/sales_operation/physical_count_model');
			      	
			      	$result = $this->physical_count_model->get_spec_data_row_spec_fields(array('*','DATE("PC_DocDate") as "PC_DocDate"'),array('md5("PC_DocNo")' => $this->input->get('id')));
			      	
			      	$content = array( 'functions' => $this->approval_functions($this->input->get('id')),
									  'table'  	  => array('tbl-physical-count-details' => array(

									 										'PCS_CS_CountSheetNo' => array('label' => 'Count Sheet No.'),
																		 	'PCS_ItemType'		  => array('label' => 'Item Type'),
																			'PCS_SubLocation'	  => array('label' => 'Sub Location'),
																			)
									 					),
									'data'		=> $result,
									'id'		=> $this->input->get('id')
									);		

					$page = array_merge($this->_settings(),array('content' => $this->load->view('app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/view',$content,true)));	
			
					if(!empty($content['data'])){
						$this->load->view("templates/container", $page);
					}else{
						redirect(site_url()."app/error");
					}	
	}

	public function details_data(){
		$this->load->model('app/sales_operation/physical_count_detail_model');
		
		$data = $this->physical_count_detail_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$details = array_map(array($this, '_map_details'), $data['data']);
			$result = array('records' 			=> $details,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->physical_count_detail_model->record_count($this->input->get('id')));
		}

		echo json_encode($result);

	}

	public function back($pk){

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_unlock($pk, $this->table);

		redirect(site_url()."app/".$this->uri->segment(2)."/".$this->uri->segment(3));
	}

	public function viewdetail(){

		$doc_no = $this->input->get('docNo');

		$data['title'] = "Store Operation: ".$this->module.": View Detail";
		$this->load->vars($data);

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$this->load->model('app/transaction_module_functions');
		$this->load->model('app/sales_operation/physical_count_detail_model');
		$this->load->model('app/sales_operation/physical_count_model');
		$this->load->model('app/sales_operation/physical_countsheet_detail_model');

		$this->load->model('app/administration/item_type_model');		

		$header = $this->physical_count_model->get_spec_data_row_spec_fields(array('*'),array('PC_DocNo' => $doc_no));
		$rawData =  $this->physical_count_detail_model->get_spec_data_array_spec_fields(											
											array(	'md5("PCS_CS_CountSheetNo"::text) as id',
													'PCS_CS_CountSheetNo',
													'PCS_PC_DocNo',
													'PCS_ItemType',
													'PCS_SubLocation',										
												 ),
											array(
												'md5("PCS_CS_CountSheetNo"::text)' => $this->input->get('id'),
												'PCS_PC_DocNo' => $doc_no
												)
											);			
		// print_r($header);
		// exit();		
		// print_r($rawData);
		// exit();
		$content['details'] = array();
		// array on fields
		foreach ($rawData["data"] AS $detail) {
			if (array_key_exists($detail["PCS_CS_CountSheetNo"], $content['details'])) {
				array_push($content['details'][$detail['PCS_CS_CountSheetNo']]["PCS_ItemType"], $detail["PCS_ItemType"]);
				array_push($content['details'][$detail['PCS_CS_CountSheetNo']]["PCS_SubLocation"], $detail["PCS_SubLocation"]);
			} else {
				$content['details'][$detail['PCS_CS_CountSheetNo']] = array(
					"PCS_CS_CountSheetNo"=> $detail["PCS_CS_CountSheetNo"],
					"PCS_ItemType" 		 => array($detail["PCS_ItemType"]),
					"PCS_SubLocation" 	 => array($detail["PCS_SubLocation"])
				);
			}
		}	
			// $detail = $this->physical_count_detail_model->get_spec_data_row_spec_fields(array('*'),array('md5("PCS_PC_DocNo"::text)' => $this->input->get('id')));
			// echo $this->db->last_query();
			// exit();
			// $header = $this->physical_count_model->get_spec_data_row_spec_fields(array('*'),array('md5("PC_DocNo")' => $this->input->get('id')));			
		$content = array( 'function'=> $this->_functions_inside(),
							 'data'	=> $header,
							 'data1'   => $content['details'],
							 'id'	 	=> $this->input->get('id')
								);

		$content['itemtypes'] = $this->item_type_model->get_spec_data_array(array('IT_Active' => '1','ITS_FK_Module_id' => $this->module_id),
																			  array(array('table' => 'tblINV_ItemTypeSetup','connector' => 'ITS_FK_ItemType_id = IT_Id')
																				   ));	

		$this->load->model('app/administration/store_profile_model');
        $content['locat'] = $this->store_profile_model->get_spec_data_array(array('SP_Active'=>'1'),
                                                                            array(array('table' => 'tblINV_Location' , 'connector' => 'SP_FK_LocationType_id = LOC_FK_Type_id')));
			// print_r($content['data1']);
			// exit();
		$this->load->model('app/sales_operation/physical_countsheet_detail_model');
		$content['details']	= $this->physical_countsheet_detail_model->get_spec_data_array_spec_fields(											
			array( //'md5("CSD_CS_CountSheetNo"::text) as id',
							'CSD_ItemType',
							'CSD_ItemNo',
							'CSD_Description',
							'CSD_UOM',
							'CSD_Count',
							'CSD_TotalQty',
							'CSD_SeriesBeg',
							'CSD_SeriesEnd',
							'CSD_SOH',
							'CSD_Comment',
					),
			array("CSD_CS_PC_DocNo" =>  $doc_no)
			);

		// print_r($content['details']);
		// exit();

			$content['data']['id']	= $this->input->get('id');

			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/viewdetail',$content,true)));	
			$this->load->view("templates/container", $page);
	}

	public function details_countsheet_data(){
		$this->load->model('app/sales_operation/physical_countsheet_detail_model');
		
		$data = $this->physical_countsheet_detail_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$details = array_map(array($this, '_map_details'), $data['data']);
			$result = array('records' 			=> $details,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);

		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->physical_countsheet_detail_model->record_count($this->input->get('id')));
		}
		echo json_encode($result);
	}
	
	public function countsheet() {
		$itemType = $this->input->get('countsheetno');
		$location = $this->input->get('location');

		$this->load->model('app/administration/item_master_model');
		$countsheetRaw = $this->item_master_model->get_spec_item($location,$itemType);
		$countsheet = array();

		//	adapt countsheet to view
		foreach ($countsheetRaw as $row) {
			array_push($countsheet, array(
				"CSD_ItemType" 	  => $row["IM_FK_ItemType_id"],
				"CSD_ItemNo" 	  => $row["IM_Item_id"],
				"CSD_Description" => $row["IM_Sales_Desc"],
				"CSD_UOM" 		  => $row["AD_Code"],
				"CSD_SOH" 		  => $row["IM_OnHandQty"],
				"CSD_TotalQty" 	  => $row["Total Qty"]
			));
		}
		echo json_encode($countsheet);
	}

	public function process(){

		$this->load->model('app/sales_operation/physical_count_model');
		$this->load->model('app/sales_operation/physical_countsheet_detail_model');
		$type = $this->input->post("type");

		switch ($this->input->post('type')) {
			case 'update':
			$id = $this->input->post('uniqid');			

			// $details = json_decode($this->input->post('details'), true);
			$data = $this->input->post(NULL,TRUE);
			$data['details'] =  json_decode($data['details'], true);

			unset($_POST['type'],$_POST['uniqid']);

				$this->_set_default();
				if($this->_validate($this->_validation_config('update',$id))){
				$_POST['PC_DocDate'] = date("Y-m-d H:i:s",time());
				$_POST['PC_Status']  = 'Open';
				
				$update = $this->physical_count_model->update_pc(array('md5("PC_DocNo"::text)' => $id),$data);

				// print_r($this->db->error());
				// exit();

				$this->load->model('app/administration/user_record_lock_model');
				$this->user_record_lock_model->record_unlock($id, $this->table);

				echo json_encode(array('result' => $update));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update-details':
				$id = $this->input->post('uniqid');
				unset($_POST['type'],$_POST['uniqid']);

				$_POST['details'] =  json_decode($this->input->post('details'), true);

				$this->_set_default();
				if($this->_validate($this->_validation_config('update-details',$id))){

				$update = $this->physical_countsheet_detail_model->update_countsheet_detail(array('md5("CSD_CS_PC_DocNo")' => $id),$this->input->post(NULL,TRUE));
	
			// print_r($this->db->error());
    //       exit();
				$this->load->model('app/administration/user_record_lock_model');
				$this->user_record_lock_model->record_unlock($id, $this->table);

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}				
			break;
			case 'send-approval-request':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

					$result = $this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id));

					$data = array('DT_DocNo' 		=> $result['PC_DocNo'],
								  'DT_FK_NSCode' 	=> explode('-', $result['PC_DocNo'])[0],
								  'DT_Location' 	=> '',
								  'DT_DocDate'  	=> $result['PC_DocDate'],
								  'DT_TargetURL' 	=> base_url().'app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/view?id='.$id 
								 );					
					$this->load->model('app/document_approval_model');
					if($this->document_approval_model->send_approval($data,$result['PC_DocNo'])){
						
						if($this->physical_count_model->update_data(array('md5("PC_DocNo"::text)' => $id),update_data(array('PC_Status' => 'Pending')))){
							echo json_encode(array('status'=>1,'message'=>$this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id))['PC_Status']));
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

				$result = $this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->approve($result['PC_DocNo'],$this->table,'PC_DocNo','PC_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id))['PC_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel($result['PC_DocNo'],$this->table,'PC_Status','PC_DocNo','tblACC_RPDetails','RPD_PFK_DocNo')){
					echo 1;
				}else{
					echo 0;
				}
			break;
			case 'reject':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->reject($result['PC_DocNo'],$this->table,'PC_DocNo','PC_Status',$this->input->post('DT_Remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id))['PC_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel-approval':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel_approval($result['PC_DocNo'],$this->table,'PC_DocNo','PC_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id))['PC_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}

			break;
			case 're-open':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->re_open($result['PC_DocNo'],$this->table,'PC_DocNo','PC_Status',$this->input->post('remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->physical_count_model->get_spec_data_row(array('md5("PC_DocNo")' => $id))['PC_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'PC_DocNo');
				
				$this->load->model('app/administration/user_record_lock_model');
				$this->user_record_lock_model->record_unlock($data['id'], $this->table);
				
				if($data){
					echo json_encode(array('result' => 1,'data'=> $data['NS_Id'].'-'.$data['NS_LastNoUsed'],'uniqid'=>$data['id']));
				}else{
					echo json_encode(array('result' => 0));
				}
			break;
			default:
				echo json_encode(array('result' => 0, 'error' => 'No Type!'));

		}
	}
	private function _validation_config($type,$uniqid=""){
		$config = array(
			'update'	=> array(

				            array(
			                 'field'   => 'PC_DocNo', 
			                 'label'   => 'Doc. No.', 
			                 'rules'   => 'TRIM|required'
				            ),				          		                
			),
			'update-details' => array(

			                array(
		                     'field'   => 'CSD_CS_PC_DocNo', 
		                     'label'   => 'Doc. No.', 
		                     'rules'   => 'TRIM|required'
			                ),				          		                
			),
	    );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(
					// 'PO_DueDate'				=> 'null',
					// 'PO_ExpectedDeliveryDate'	=> 'null',
					// 'PO_ValidityDate'			=> 'null'
					);

		$this->load->library('set_default');
		$this->set_default->set_config($config);
		$this->set_default->run();
	}

	private function _validate($data){
		
		$this->form_validation->set_rules($data);

		return $this->form_validation->run();
	}	
	
	private function _checkbox($id=""){
		return '<input type="checkbox" class="doc" id="'.$id.'" />';
	}

	private function _map(&$value){
		
		$value['checkbox']      	= $this->_checkbox($value['id']);
		$value['buttons'] 	    	= $this->_access_inline($value['id'],$value['PC_Status']);

		$value['PC_CountDate']		= format($value['PC_CountDate']);
		$value['PC_DocDate']		= format($value['PC_DocDate']);
		remove_null_in_array($value);
		
		return $value;
		
	}
	private function _map_details(&$value){

			
		remove_null_in_array($value);

		return $value;
	}
	
	private function _map_details_data(&$value){

		// if ($value["RPD_Qty"]) {
  //           $value["RPD_Qty"] = number_format(doubleval($value["RPD_Qty"]), 0);
  //       }

		remove_null_in_array($value);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
	}

	private function _functions_inside($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_inside(array('UF_FK_Module_id'=> $this->module_id))),true);
	
	}
	private function _access_inline($id="",$status=NULL){

		$this->load->model('app/administration/user_profile_model');
		$access = $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->module_id));
		
		if(!$status){
			unset($access[array_search('View', array_column($access, 'UA_AccessName'))]);
		}

		if(in_array($status, array('Pending','Approved'))){
			unset($access[array_search('Edit', array_column($access, 'UA_AccessName'))]);
		}

		return  $this->load->view("templates/access_inline",array('id'		=> $id,
																  'access' 	=> $access),true);
	}
	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}
	private function _access_header_inside($id){

		$this->load->model('app/administration/user_profile_model');
		
		$access = $this->user_profile_model->get_module_access_per_pos_header_inside(array('UP_FK_Module_id'	=> $this->module_id));
	
		return  $this->load->view("templates/access_inline_inside",array('id'		=> $id,
																		 'access' 	=> $access),true);

	}
	private function _access_inline_inside($id){
		$this->load->model('app/administration/user_profile_model');
		
		$access = $this->user_profile_model->get_module_access_per_pos_inline_inside(array('UP_FK_Module_id'	=> $this->module_id));

		return  $this->load->view("templates/access_inline_inside",array('id'		=> $id,
																		'access' 	=> $access),true);
	}
	
}
