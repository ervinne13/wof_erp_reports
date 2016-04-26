<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Generic_Module_Controller
 *
 * @author Ervinne Sodusta
 */
abstract class Generic_Module_Controller extends CI_Controller {

    const MODE_DETAIL_INLINE_EDITABLE = 1;
    const MODE_DETAIL_NEW_PAGE_EDIT   = 2;

    protected $module_id;
    protected $header_doc_no_field_name;
    protected $header_table_name;
    protected $detail_table_name;
    protected $category                   = "";
    protected $module_name                = "";
    protected $detail_edit_mode;
    //  document series
    //  TODO: check if this could be on a separate class/helper/facade as document series
    //  could be considered a separate entity, also to lessen the size of this controller.
    protected $document_series_enabled    = false;
    protected $document_series_field_name = null;
    protected $on_create_values           = null;

    public function __construct($module_id, $header_doc_no_field_name, $header_table_name, $detail_table_name, $detail_edit_mode = self::MODE_DETAIL_NEW_PAGE_EDIT) {
        parent::__construct();

        $this->module_id                = $module_id;
        $this->header_doc_no_field_name = $header_doc_no_field_name;
        $this->header_table_name        = $header_table_name;
        $this->detail_table_name        = $detail_table_name;
        $this->detail_edit_mode         = $detail_edit_mode;
    }

    protected function default_settings() {
        $data['title']     = "{$this->category}: {$this->module_name}";
        $data['mod_group'] = $this->session->userdata('grouping');
        $data['sub_mod']   = $this->session->userdata($this->uri->segment(2));
        $data['all_mod']   = $this->session->userdata('all');

        $this->load->vars($data);
        $page = array('header' => $this->load->view("templates/header", "", true),
            'footer' => $this->load->view("templates/footer", "", true),
            'navs'   => $this->load->view('templates/side-nav', "", true),
            'head'   => $this->load->view("templates/head-nav", "", true),
        );
        return $page;
    }

    protected function load_view_with_default_settings($view, $data = array()) {
        if ($data) {
            $this->load->vars($data);
        }
        $page = array_merge($this->default_settings(), array('content' => $this->load->view($view, $data, true)));
        $this->load->view("templates/container", $page);
    }

    /**
     * To enable document series, this function must be called. Otherwise, the 
     * system will tell the users that there are no document series available.
     * @param String $document_series_field_name
     *  This is where the document series value will be stored
     * @param Array $on_create_values
     *  Set this to add initial values when a document is created with a generated document series
     */
    protected function enable_document_series($document_series_field_name, $on_create_values = array()) {
        $this->document_series_enabled    = true;
        $this->document_series_field_name = $document_series_field_name;
        $this->on_create_values           = $on_create_values;
    }

    //
    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Default View Methods">

    public function index() {

        $data["header_table"] = $this->get_header_table_definition();
        $data["detail_table"] = $this->get_detail_table_definition();

        $this->load_view_with_default_settings(uri_string() . "/index", $data);
    }

    public function generate_table() {
        echo generate_table($this->get_detail_table_definition());
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Default Data/API Methods">

    public function getseries() {

        //  TODO: add catcher in the no.series.js so the message here will be displayed. See no.series.js line 55
        if (!$this->document_series_enabled) {
            echo json_encode(array('error' => 1, 'rows' => 0, 'message' => 'Number series not enabled in this module!'));
            return;
        }

        $this->load->model('app/administration/no_series_model');
        $data = $this->no_series_model->get_no_series($this->module_id, $this->header_table_name, $this->document_series_field_name, $this->on_create_values);

        if ($data['rows'] == 0) {
            echo json_encode(array('rows' => $data['rows']));
        } else if ($data['rows'] == 1) {
            echo json_encode(array('rows' => $data['rows'], 'data' => $data['data'][0]['NS_Id'] . '-' . $data['data'][0]['nsnum'], 'uniqid' => $data['data'][0]['uniq']));
        } else {
            echo json_encode(array('rows' => $data['rows']));
        }
    }

    public function process() {
        try {
            $type = $this->input->post("type");
            unset($_POST['type']);

            switch ($type) {
                case 'add': echo $this->store();
                    break;
                case 'update': echo $this->update();
                    break;
                case 'delete': echo $this->destroy();
                    break;
                case 'add-details': echo $this->store_detail();
                    break;
                case 'update-details': echo $this->update_detail();
                    break;
                case 'delete-details': echo $this->destroy_detail();
                    break;
                case 'docseries': echo $this->document_series();
                    break;
                default:
                    echo $this->process_function($type);
//                    echo json_encode(array('result' => 0, 'errors' => "Unknown action {$type}"));
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array('result' => 0, 'errors' => $e->getMessage()));
        }
    }

    public function header_data() {

        $data = $this->get_header_table_data();

        if (!empty($data['rows'])) {

            $dataresult = array_map(array($this, 'map_header_data'), $data['data']);

            $result = array(
                'records'          => $dataresult,
                'queryRecordCount' => $data['rows'],
                'totalRecordCount' => $this->get_all_header_data()['rows']);
        } else {

            $result = array(
                'records'          => [],
                'queryRecordCount' => 0,
                'totalRecordCount' => $this->get_all_header_data()['rows']);
        }

        echo json_encode($result);
    }

    public function detail_data() {

        $data = $this->get_detail_table_data();

        if (!empty($data['rows'])) {
            $dataresult = array_map(array($this, 'map_detail_data'), $data['data']);

            $result = array(
                'records'          => $dataresult,
                'queryRecordCount' => $data['rows'],
                'totalRecordCount' => $data['rows']
            );
        } else {
            $result = array(
                'records'          => [],
                'queryRecordCount' => 0,
                'totalRecordCount' => 0
            );
        }

        echo json_encode($result);
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Contracts">

    /**
     * Implementation must return the definition of the table in the following format:
     * array('table-id-generated-in-the-view' => array(
     *  'your_column'    => array('label' => 'Your label name')
     *  . . . and so on
     *  )     
     * );
     */
    protected abstract function get_header_table_definition();

    /**
     * Implementation must return the definition of the table in the following format:
     * array('table-id-generated-in-the-view' => array(
     *  'your_column'    => array('label' => 'Your label name')
     *  . . . and so on
     *  )     
     * );
     */
    protected abstract function get_detail_table_definition();

    protected abstract function get_header_table_data();

    protected abstract function get_all_header_data();

    protected abstract function get_detail_table_data();

    protected abstract function store();

    protected abstract function store_detail();

    protected abstract function update();

    protected abstract function update_detail();

    protected abstract function destroy();

    protected abstract function destroy_detail();

    protected abstract function process_function($function_type);

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Utility Functions">

    protected function currency_format_fields(&$datasource, $fields) {

        foreach ($fields AS $field) {
            if ($datasource[$field]) {
                $datasource[$field] = number_format(doubleval($datasource[$field]), 2);
            }
        }
    }

    protected function access_header() {
        $this->load->model('app/administration/user_profile_model');
        return $this->load->view("templates/access_inline", array('access' => $this->user_profile_model->get_module_access_per_pos_header_outside(array('UP_FK_Module_id' => $this->module_id))), true);
    }

    protected function access_header_inside($id) {
        $this->load->model('app/administration/user_profile_model');
        $access = $this->user_profile_model->get_module_access_per_pos_header_inside(array('UP_FK_Module_id' => $this->module_id));
        return $this->load->view("templates/access_inline_inside", array('id' => $id, 'access' => $access), true);
    }

    protected function map_header_data(&$data) {
        $data['buttons'] = $this->access_inline($data['id'], null, $data);
        return $this->_remove_null_values($data);
    }

    protected function map_detail_data(&$data) {
        $data['buttons'] = $this->access_inline_inside($data['id']);
        return $this->_remove_null_values($data);
    }

    private function _remove_null_values(&$data) {
        foreach ($data AS $key => $item) {
            if ($item === null) {
                $data[$key] = '';
            }
        }
        return $data;
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Utility Functions For Series">
    public function getseries_update() {
        $this->load->model('app/administration/no_series_model');
        echo json_encode($this->no_series_model->getseries_update($this->module_id));
    }

    public function seriesmodal() {
        $this->load->model('app/administration/no_series_model');
        $data = $this->no_series_model->get_no_series($this->module_id);
        $this->load->view('app/administration/no-series/series', $data);
    }

    protected function document_series() {

        if (!$this->document_series_enabled) {
            throw new Exception("Document series not enabled in this module");
        }

        $this->load->model('app/administration/no_series_model');
        $data = $this->no_series_model->add_data_series(
                $this->input->post(NULL, TRUE), $this->header_table_name, $this->document_series_field_name, null, $this->on_create_values
        );

        $this->load->model('app/administration/user_record_lock_model');
        $this->user_record_lock_model->record_unlock($data['id'], $this->header_table_name);

        if ($data) {
            echo json_encode(array('result' => 1, 'data' => $data['NS_Id'] . '-' . $data['NS_LastNoUsed'], 'uniqid' => $data['id']));
        } else {
            echo json_encode(array('result' => 0));
        }
    }

    //  </editor-fold>

    /*     * ************************************************************************* */
    //  <editor-fold defaultstate="collapsed" desc="Utility Functions For Access">
    protected function access_inline($id = "", $status = NULL, $document_data = NULL) {

        $this->load->model('app/administration/user_profile_model');
        $access = $this->user_profile_model->get_module_access_per_pos_inline_outside(array('UP_FK_Module_id' => $this->module_id));

        if ($status == 'Cancel') {
            unset($access[array_search('View', array_column($access, 'UA_AccessName'))]);
        }

        if (in_array($status, array('Pending', 'Approve'))) {
            unset($access[array_search('Edit', array_column($access, 'UA_AccessName'))]);
        }

        $display_details_button = array(
            "UA_Get"          => 0,
            "UA_FK_Module_id" => $this->module_id,
            "UA_AccessName"   => "View Details",
            "UA_Trigger"      => "action-view-head-details",
            "UA_Icon"         => "glyphicon-list-alt"
        );

        if ($document_data) {
            $display_details_button["params"] = array(
                "data-document-no" => $document_data[$this->header_doc_no_field_name]
            );
        }

        array_push($access, $display_details_button);

        return $this->load->view("templates/access_inline", array('id' => $id, 'access' => $access), true);
    }

    protected function access_inline_inside($id) {
        $this->load->model('app/administration/user_profile_model');
        $access = $this->user_profile_model->get_module_access_per_pos_inline_inside(array('UP_FK_Module_id' => $this->module_id));

        //  no view access on details
//        unset($access[array_search('View', array_column($access, 'UA_AccessName'))]);

        return $this->load->view("templates/access_inline_inside", array('id' => $id, 'access' => $access), true);
    }

    protected function plain_access_inline_inside() {
        $this->load->model('app/administration/user_profile_model');
        $access_list = $this->user_profile_model->get_module_access_per_pos_inline_inside(array('UP_FK_Module_id' => $this->module_id));

        $access_map = array(
            "edit"   => false,
            "delete" => false,
        );
        foreach ($access_list AS $access) {
            if ($access["UA_AccessName"] == "Edit") {
                $access_map["edit"] = true;
            }

            if ($access["UA_AccessName"] == "Delete") {
                $access_map["delete"] = true;
            }
        }

        return $access_map;
    }

    //  </editor-fold>
}
