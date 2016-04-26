<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

  private $module_id = 276;
  
  private $table 	 = "tblINV_Item";

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

	public function index()
	{		
		$data['title'] = "Administration: Services";
      	$this->load->vars($data);

		$content = array('function'=> $this->_functions(),
						 'table'  => array('tbl-services' 			=> array(
						 										'buttons'						=> array('label' => $this->_access_header(),'sorts' => true),
															 	'checkbox'					=> array('label' => '<input type="checkbox" class="toggle-check">','sorts' => true),
															 	'IM_Item_id'						=> array('label' => 'Code'),
																'IM_Sales_Desc'		=> array('label' => 'Description'),
																'IM_Active'					=> array('label' => 'Active'),
																)
						 					)
						);
	
		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string()."/index",$content,true)));	

		$this->load->view("templates/container", $page);
	}
	
	public function data(){
		
		$this->load->model('app/administration/services_model');

		$data = $this->services_model->table_data($this->input->get());

		if(!empty($data['rows'])){
			$dataresult  = array_map(array($this, '_map'), $data['data']);

			$result = array('records' 	=> $dataresult,
							'queryRecordCount'	=> $data['rows'],
							'totalRecordCount'	=> $data['count']);
		}else{
			
			$result = array('records' 			=> [],
							'queryRecordCount'	=> 0,
							'totalRecordCount'	=> $this->services_model->record_count());
		}

		echo json_encode($result);

	}

	public function json($id){
		$this->load->model('app/administration/services_model');
		echo json_encode($this->services_model->get_all_spec_data(array('IM_Item_id' => $id))['data']);
	}

	public function add(){
		
		if(!check_access($this->module_id,'Add')){
				redirect(site_url()."app/error");
			}

		$data['title'] = "Administration: Services: Add";
    $this->load->vars($data);
   
		$this->load->model('app/financial_management/VAT_prod_posting_group_model');
		$content['VAT'] 	= $this->VAT_prod_posting_group_model->get_spec_data_array(array('VPPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_prod_posting_group_model');
		$content['WHT'] 	= $this->WHT_prod_posting_group_model->get_spec_data_array(array('WPPG_Active'=>'1'));

		$this->load->model('app/financial_management/Inventory_posting_group_model');
		$content['INV'] 	= $this->Inventory_posting_group_model->get_spec_data_array(array('IPG_Active'=>'1'));

		$this->load->model('app/administration/department_setup_model');
		$content['dep'] 	= $this->department_setup_model->get_spec_data_array(array('DEP_Active'=>'1'));

		$this->load->model('app/administration/item_type_model');
		$content['data'] 	= $this->item_type_model->get_spec_data_array(array('IT_Services' => '1'));


		$page = array_merge($this->_settings(),array('content' => $this->load->view(uri_string(),$content,true)));	

		$this->load->view("templates/container", $page);
	}


	public function update($id=""){
		
		if(!check_access($this->module_id,'Edit')){
				redirect(site_url()."app/error");
			}

		$this->load->model('app/administration/user_record_lock_model');
		$this->user_record_lock_model->record_lock($this->input->get('id'), $this->table);

		$data['title'] = "Administration: Services: Edit";
        $this->load->vars($data);

		$this->load->model('app/financial_management/VAT_prod_posting_group_model');
		$content['VAT'] 	= $this->VAT_prod_posting_group_model->get_spec_data_array(array('VPPG_Active'=>'1'));

		$this->load->model('app/financial_management/WHT_prod_posting_group_model');
		$content['WHT'] 	= $this->WHT_prod_posting_group_model->get_spec_data_array(array('WPPG_Active'=>'1'));

		$this->load->model('app/financial_management/Inventory_posting_group_model');
		$content['INV'] 	= $this->Inventory_posting_group_model->get_spec_data_array(array('IPG_Active'=>'1'));
		
		$this->load->model('app/administration/item_type_model');
		$content['services'] 	= $this->item_type_model->get_spec_data_array(array('IT_Services' => '1'));

		$this->load->model('app/administration/department_setup_model');
		$content['dep'] 	= $this->department_setup_model->get_spec_data_array(array('DEP_Active'=>'1'));

		$this->load->model('app/administration/services_model');

		$content['data']		= $this->services_model->get_spec_data_row(array('md5("IM_Item_id")' => $this->input->get('id')));
		$content['data']['id']	= $this->input->get('id');
		$this->load->model('app/administration/category_model');
		$content['category'] 	= $this->category_model->get_spec_data_array(array('CAT_FK_ItemType_id' => $content['data']['IM_FK_ItemType_id']));

		$this->load->model('app/administration/sub_category_model');
		$content['subcategory'] = $this->sub_category_model->get_spec_data_array(array('SC_FK_Category_id' => $content['data']['IM_FK_Category_id']));

		$this->load->model('app/administration/identifier_setup_model');
		$identifier = $this->identifier_setup_model->get_all_spec_data_json($content['data']['IM_FK_Category_id'],$content['data']['IM_FK_SubCategory_id']);
		
		$this->load->model('app/administration/item_master_model');
		$identifier['peritem'] = $this->item_master_model->get_identifiers_per_item(array('md5("IMI_FK_Item_id")' 	=> $this->input->get('id')));

 		$content['identifiers'] = $this->load->view('app/administration/item-master/identifier',$identifier,true);
		
			
		if(!empty($content['data'])){
			$page = array_merge($this->_settings(),array('content' => $this->load->view('app/administration/services/update',$content,true)));	
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

		$this->load->model('app/administration/services_model');

		switch ($this->input->post('type')) {
			case 'add':
			unset($_POST['type']);
				$this->_set_default();
				if($this->_validate($this->_validation_config('add'))){
					$_POST['IM_Active'] 		= '1';
					
					$this->load->model('app/administration/item_master_model');
					$this->item_master_model->add_data($this->input->post(NULL,TRUE));

					echo json_encode(array('result' => 1));
				}else{
					echo json_encode(array('result' => 0,'errors' =>$this->form_validation->error_array()));
				}
			break;
			case 'update':
			// print_r($_POST);
			$id = $this->input->post('uniqid');
			unset($_POST['type']);
				$this->_set_default();
				if($this->_validate($this->_validation_config('update',$id))){
					unset($_POST['uniqid']);
					
					$this->load->model('app/administration/item_master_model');
					$this->item_master_model->update_data(array('md5("IM_Item_id")' => $id),update_data($this->input->post(NULL,TRUE)));
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
					
					$this->services_model->update_data(array('md5("IM_Item_id"::text)' => $value),update_data(array('IM_Active' => '1')));

				}
			break;
			case 'deactivate':
				$id = json_decode($this->input->post('id'));
				foreach ($id as $key => $value) {
					
					$this->services_model->update_data(array('md5("IM_Item_id"::text)' => $value),update_data(array('IM_Active' => '0')));

				}
			break;
			case 'delete':
				
				echo  $this->services_model->delete(array('md5("IM_Item_id"::text)' => $this->input->post('id')));

			break;
		}
	}

	private function _validation_config($type,$uniqid=""){
		$config = array(
			'add' 		=> array(
			                array(
			                     'field'   => 'IM_Item_id', 
			                     'label'   => 'Item Code', 
			                     'rules'   => 'TRIM|required|is_unique[tblINV_Item.IM_Item_id]'
			                  ),
			                 array(
			                     'field'   => 'IM_Sales_Desc', 
			                     'label'   => 'Sales Description', 
			                     'rules'   => 'TRIM|required|max_length[200]'
			                  ),
							array(
			                     'field'   => 'IM_VATProductPostingGroup', 
			                     'label'   => 'VAT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
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
			            ),
			'update'	=> array(
							array(
				                     'field'   => 'IM_Item_id', 
				                     'label'   => 'Item Code', 
				                     'rules'   => 'TRIM|required|is_unique2[tblINV_Item.IM_Item_id.md5("IM_Item_id").'.$uniqid.']'
				                 ),
							array(
			                     'field'   => 'IM_Sales_Desc', 
			                     'label'   => 'Sales Description', 
			                     'rules'   => 'TRIM|required|max_length[200]'
			                  ),
						 	array(
			                     'field'   => 'IM_VATProductPostingGroup', 
			                     'label'   => 'VAT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                array(
			                     'field'   => 'IM_INVPosting_Group', 
			                     'label'   => 'Inventory Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
			                 array(
			                     'field'   => 'IM_WHTProductPostingGroup', 
			                     'label'   => 'WHT Posting Group', 
			                     'rules'   => 'TRIM|max_length[30]'
			                  ),
						),
            );
		return $config[$type];
	}

	private function _set_default(){
		
		$config = array(			
					'IM_VATProductPostingGroup'	=> 'null',					
					'IM_INVPosting_Group'		=> 'null',
					'IM_WHTProductPostingGroup'	=> 'null',
					'IM_FK_ItemType_id'			=> 'null',
					'IM_FK_Department_id'		=> 'null',					
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
		
		$value['checkbox']  = $this->_checkbox($value['id']);
		$value['buttons'] 	= $this->_access_inline($value['id']);

		return $value;
	}

	private function _functions($params=array()){

		$this->load->model('app/administration/user_function_model');

		return $this->load->view("templates/functions",array('attr'		=> $params,
															 'function' => $this->user_function_model->get_module_function_per_pos_outside(array('UF_FK_Module_id'	=> $this->module_id))),true);
	
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
