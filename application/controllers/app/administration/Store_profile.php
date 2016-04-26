<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_profile extends CI_Controller {
  
  private $module_id = 247;

  private $table 	 = "tblINV_StoreProfile";

  public function __construct()
    {
        parent::__construct();
      	
      	if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }
    public function getseries_update(){
    	$this->load->model('app/administration/no_series_model');
    	echo json_encode($this->no_series_model->getseries_update($this->module_id));
    }

    public function getseries(){
		
		$this->load->model('app/administration/no_series_model');
		$data = $this->no_series_model->get_no_series($this->module_id,$this->table,'SP_DocNo',array('SP_StoreID' => 'temp-'.uniqid()));
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

	public function index()
	{		
		$data['title'] = "Administration: Store Profile";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-store-profile' => array(
						 										'buttons'		=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'		=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'SP_StoreID'		=> array('label' => 'Store ID'),
																'SP_StoreName'		=> array('label' => 'Store Name'),
																'SP_Address'		=> array('label' => 'Address'),
																'SP_TelNo'	=> array('label' => 'Telephone #'),
																'SP_Active'	=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function data(){
		
		$this->load->model('app/administration/Store_profile_model');

		$data = $this->Store_profile_model->table_data($this->input->get());

		if(!empty($data['rows'])){

			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 			=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->Store_profile_model->record_count());
		}

		echo json_encode($result);

	}

	public function add(){

		if(!check_access($this->module_id,'Add')){
			redirect(site_url()."app/error");
		}
		$data['title'] = "Administration: Store Profile: Add";
      	$this->load->vars($data);

      	$this->load->model('app/administration/company_model');
		$content['com'] = $this->company_model->get_spec_data_array(array('COM_Active'=>'1'));

		$this->load->model('app/administration/cost_profit_center_model');
		$content['cpc'] = $this->cost_profit_center_model->get_spec_data_array(array('CPC_Active'=>'1'));

		$this->load->model('app/administration/store_profile_model');
		$content['store'] = $this->store_profile_model->get_spec_data_array(array('SP_StoreType' => '2'));

		$this->load->model('app/administration/attribute_model');
		$content['reg']  = $this->attribute_model->get_spec_attribute_dropdown('260');
		$content['area'] = $this->attribute_model->get_spec_attribute_dropdown('261');
		$content['loc'] = $this->attribute_model->get_spec_attribute_dropdown('144');
		
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}

	public function update($id=""){

		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}
		
		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: StoreProfile: Edit";
      	$this->load->vars($data);


        $this->load->model('app/administration/company_model');
		$content['com'] = $this->company_model->get_spec_data_array(array('COM_Active'=>'1'));

		$this->load->model('app/administration/cost_profit_center_model');
		$content['cpc'] = $this->cost_profit_center_model->get_spec_data_array(array('CPC_Active'=>'1'));

		$this->load->model('app/administration/attribute_model');
		$content['reg'] = $this->attribute_model->get_spec_attribute_dropdown('260');
		$content['area'] = $this->attribute_model->get_spec_attribute_dropdown('261');
		$content['loc'] = $this->attribute_model->get_spec_attribute_dropdown('144');

		$this->load->model('app/administration/store_profile_model');

		$content['store'] = $this->store_profile_model->get_spec_data_array(array('SP_StoreType' => '2'));
		$content['data'] =  $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' 	=>  $this->input->get('id')));
		$content['functions'] 	= $this->approval_functions($this->input->get('id'));
		if(!empty($content['data'])){
			$content['data']['id'] = $this->input->get('id'); 
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/store-profile/update',$content,true)));	
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

		$this->load->model('app/administration/store_profile_model');

		$mainstore 	 = array(
	                     'field'   => 'SP_MainStore', 
	                     'label'   => 'Main Store', 
	                     'rules'   => 'TRIM'
                  		);

		$cpc 		 = array(
	                     'field'   => 'SP_FK_CPC_id', 
	                     'label'   => 'Cost Profit Center', 
	                     'rules'   => 'TRIM|required'
		                  );

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
			$config = $this->_validation_config('add');
			if($this->input->post('SP_StoreType')==3){
				$mainstore['rules'] .= '|required';
				$result = $this->store_profile_model->get_spec_data_row(array('SP_StoreID' => $this->input->post('SP_MainStore',true)));
				$_POST['SP_FK_CPC_id'] = $result['SP_FK_CPC_id'];
				array_push($config,$mainstore,$cpc);
			}
				$this->_set_default();
				if($this->_validate($this->_validation_config('add'))){
					$_POST['SP_Active'] = '1';
					
					$this->Store_profile_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			 
			unset($_POST['type']);
			$id = $this->input->post('uniqid');
			$config = $this->_validation_config('update',$id);
			if($this->input->post('SP_StoreType')==3){
				$mainstore['rules'] .= '|required';
				$result = $this->store_profile_model->get_spec_data_row(array('SP_StoreID' => $this->input->post('SP_MainStore',true)));
				$_POST['SP_FK_CPC_id'] = $result['SP_FK_CPC_id'];
				array_push($config,$mainstore,$cpc);
			}

				$this->_set_default();
				if($this->_validate($config)){
					unset($_POST['uniqid']);
					
					$updates = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));
					
					$_POST['SP_Active'] 	= '0';
					$_POST['SP_Status'] 	= 'Open';
					$_POST['SP_Updates'] 	= json_encode(array_diff_assoc($updates,$this->input->post(NULL,TRUE)));;

					$this->store_profile_model->update_data(array('md5("SP_DocNo")' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->store_profile_model->update_data(array('md5("SP_DocNo")' => $value),update_data(array('SP_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->store_profile_model->update_data(array('md5("SP_DocNo")' => $value),update_data(array('SP_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->store_profile_model->delete(array('md5("SP_DocNo")' => $this->input->post('id')));

			break;
			case 'send-approval-request':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

					$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));

					$data = array('DT_DocNo' 		=> $result['SP_DocNo'],
								  'DT_FK_NSCode' 	=> explode('-', $result['SP_DocNo'])[0],
								  'DT_Location' 	=> '',
								  'DT_DocDate'  	=> $result['DateCreated'],
								  'DT_TargetURL' 	=> base_url().'app/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/update?id='.$id 
								 );
					
					$this->load->model('app/document_approval_model');
					if($this->document_approval_model->send_approval($data,NULL)){
						
						if($this->store_profile_model->update_data(array('md5("SP_DocNo"::text)' => $id),update_data(array('SP_Status' => 'Pending')))){
							echo json_encode(array('status'=>1,'message'=>$this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id))['SP_Status']));
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

				$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->approve($result['SP_DocNo'],$this->table,'SP_DocNo','SP_Status')){
					$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));
					if($result['SP_Status'] == 'Approved'){
						$this->store_profile_model->update_data(array('md5("SP_DocNo"::text)' => $id),array('SP_Active'=>'1','SP_Updates' => '[]'));
					}
					echo json_encode(array('status'=>1,'message'=>$result['SP_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel($result['SP_DocNo'],$this->table,'SP_Status','SP_DocNo','tblACC_RPDetails','RPD_PFK_DocNo')){
					echo 1;
				}else{
					echo 0;
				}
			break;
			case 'reject':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->reject($result['SP_DocNo'],$this->table,'SP_DocNo','SP_Status',$this->input->post('DT_Remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id))['SP_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'cancel-approval':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->cancel_approval($result['SP_DocNo'],$this->table,'SP_DocNo','SP_Status')){
					echo json_encode(array('status'=>1,'message'=>$this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id))['SP_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}

			break;
			case 're-open':
				$id	= $this->input->post('id');
				unset($_POST['type'],$_POST['id']);

				$result = $this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id));

				$this->load->model('app/document_approval_model');
				if($this->document_approval_model->re_open($result['SP_DocNo'],$this->table,'SP_DocNo','SP_Status',$this->input->post('remarks'))){
					echo json_encode(array('status'=>1,'message'=>$this->store_profile_model->get_spec_data_row(array('md5("SP_DocNo")' => $id))['SP_Status']));
				}else{
					echo json_encode(array('status'=>0));
				}
			break;
			case 'docseries':
				
				unset($_POST['type']);
					
				$this->load->model('app/administration/no_series_model');
				$data = $this->no_series_model->add_data_series($this->input->post(NULL,TRUE),$this->table,'SP_StoreID','SP_Active');
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

	public function getdata(){
		switch ($this->input->get('type')) {
			case 'cpc':
				$this->load->model('app/administration/store_profile_model');
				$result = $this->store_profile_model->get_spec_data_row(array('SP_StoreID' => $this->input->get('data',true)));
				if($result){
					echo $result['SP_FK_CPC_id'];
				}
				break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' => array(
			                array(
			                     'field'   => 'SP_StoreID', 
			                     'label'   => 'Store ID', 
			                     'rules'   => 'TRIM|required|is_unique[tblINV_StoreProfile.SP_StoreID]'
			                  ),	
			                  array(
			                     'field'   => 'SP_StoreName', 
			                     'label'   => 'Store Name', 
			                     'rules'   => 'TRIM|required|max_length[100]'
			                  ),
			                  array(
			                     'field'   => 'SP_StoreType', 
			                     'label'   => 'Store Type', 
			                     'rules'   => 'TRIM|required|max_length[30]'
			                  )
			            ),
			'update'	=> array(
								  array(
				                     'field'   => 'SP_StoreID', 
				                     'label'   => 'Store ID', 
				                     'rules'   => 'TRIM|required|is_unique2[tblINV_StoreProfile.SP_StoreID.SP_StoreID.'.$this->input->post('SP_StoreID').']'
				                 		),	
					              array(
				                     'field'   => 'SP_StoreName', 
				                     'label'   => 'Store Name', 
				                     'rules'   => 'TRIM|required|max_length[100]'
				                  ),
								  array(
				                     'field'   => 'SP_StoreType', 
				                     'label'   => 'Store Type', 
				                     'rules'   => 'TRIM|required|max_length[30]'
			                  	  ),
				            )
            );
		
		$extra = array(
						 array(
		                     'field'   => 'SP_Address', 
		                     'label'   => 'Address', 
		                     'rules'   => 'TRIM|required|max_length[100]'
		                  ),	
		                  array(
		                     'field'   => 'SP_StoreConcept', 
		                     'label'   => 'Store Concept', 
		                     'rules'   => 'TRIM|required|max_length[30]'
		                  ),	
		                  array(
		                     'field'   => 'SP_StoreClass', 
		                     'label'   => 'Class', 
		                     'rules'   => 'TRIM|required|max_length[30]'
		                  ),	
		                  array(
		                     'field'   => 'SP_TelNo', 
		                     'label'   => 'Telephone #', 
		                     'rules'   => 'TRIM|max_length[30]'
		                  ),	
		                  array(
		                     'field'   => 'SP_FaxNo', 
		                     'label'   => 'Fax #', 
		                     'rules'   => 'TRIM|max_length[30]'
		                  ),
		                  array(
		                     'field'   => 'SP_TinNo', 
		                     'label'   => 'TIN #', 
		                     'rules'   => 'TRIM|max_length[16]'
		                  ),
		                  array(
		                     'field'   => 'SP_ContractDuration', 
		                     'label'   => 'Contract Duration', 
		                     'rules'   => 'TRIM|max_length[30]'
		                  ),	
		                  array(
		                     'field'   => 'SP_FloorArea', 
		                     'label'   => 'Floor Area', 
		                     'rules'   => 'TRIM|required|numeric'
		                  ),
		                  array(
		                     'field'   => 'SP_FK_CompanyID', 
		                     'label'   => 'Company', 
		                     'rules'   => 'TRIM|required'
		                  ),
						  array(
		                     'field'   => 'SP_FixedRent', 
		                     'label'   => 'Sharing Scheme', 
		                     'rules'   => 'TRIM|numeric|max_length[30]'
		                  )
		                );

		if($this->input->post('SP_StoreType') != 1){
			return array_merge($config[$type], $extra);
		}else{
			return $config[$type];
		}

	}

	private function _set_default(){
		
		$config = array(
			  			'SP_FloorArea'			=> 'numeric',
			  			'SP_FixedRent'			=> 'numeric',
						'SP_FK_CompanyID'		=> 'null',
						'SP_FK_LocationType_id'	=> 'null',
						'SP_DateOpened'			=> 'null',
						'SP_DateClosed'			=> 'null',
						'SP_FK_LocationType_id'	=> 'null',
						'SP_Region'				=> 'null',
						'SP_Area'				=> 'null'
					);
		if($this->input->post('SP_MainStore')){
			$config['SP_MainStore']	= 'null';
		}

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
		
		$value['checkbox']  = $value['SP_Status'] == 'Approved' ? $this->_checkbox($value['id']):'';
		$value['buttons'] 	= $this->_access_inline($value['id']);

		remove_null_in_array($value);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
	}

	private function approval_functions($id){

		$this->load->model('app/administration/store_profile_model');
		$this->load->model('app/transaction_module_functions');

		$result = $this->store_profile_model->get_spec_data_row_spec_fields(array('SP_DocNo'),array('md5("SP_DocNo")' => $id));

		$function['functions'] = $this->transaction_module_functions->get_module_functions($this->table,$result['SP_DocNo'],'SP_DocNo','SP_Status','CreatedBy',$this->module_id);
		
		$function['id']		   = $id;
		
		return $this->load->view("templates/approval_functions",$function,true);

	}


	private function _access_inline($id=""){

		$this->load->model('app/administration/user_profile_model');
		return  $this->load->view("templates/access_inline",array('id'		=> $id,
																  'access' 	=> $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);
	}

	private function _access_header($id=""){

		$this->load->model('app/administration/user_profile_model');

		return  $this->load->view("templates/access_inline",array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id'	=> $this->module_id))),true);

	}
	
}
