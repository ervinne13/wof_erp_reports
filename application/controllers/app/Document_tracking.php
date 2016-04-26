<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_tracking extends CI_Controller{

  public function __construct()
    {
        parent::__construct();
        
        if(!is_logged_in()['status']){
          redirect(site_url());
        }
    }

  public function data($id){
    
    $this->load->model('app/document_tracking_model');

    $data = $this->document_tracking_model->table_data($this->input->get(),$id);

    if(!empty($data['rows'])){

      $dataresult  = array_map(array($this, '_map'), $data['data']);

      $result = array('records'       => $dataresult,
                  'queryRecordCount'  => $data['rows'],
                  'totalRecordCount'  => $data['count']);
    }else{
      
      $result = array('records'       => [],
                  'queryRecordCount'  => 0,
                  'totalRecordCount'  => $this->document_tracking_model->record_count());
    }

    echo json_encode($result);

  }

  public function getData($id){

    $this->load->model('app/document_tracking_model');

    echo json_encode($this->document_tracking_model->get_spec_data_row_spec_fields(array('*',
                  '"P_Position" as "Position"',
                  "COALESCE(".'"DT_ApprovedBy"::text'.",'') as  ".'"ApprovedBy"'." ",
                  "COALESCE(".'"DT_DateApproved"::text'.",'') as  ".'"DateApproved"'." ",
                  ),array('md5("DT_DocNo")' => $id))['data']);

  }

  public function getNotifs(){

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    $this->load->model('app/document_approval_model');
    $result = $this->document_approval_model->table_data(array());
   echo "data: ".json_encode($result['data'])."\n\n";
    
   ob_end_flush();
   flush();
   sleep(1);

  } 

  private function _map(&$value){
    // echo "<pre>";
    // print_r($value);
    $value['DateApproved']    = format_datetime($value['DT_DateApproved']);
    $value['DT_EntryDate']    = format_datetime($value['DT_EntryDate']);

    foreach ($value AS $key => $item) {
            if ($item === null) {
                $value[$key] = '';
            }
        }

    return $value;
  }
}
