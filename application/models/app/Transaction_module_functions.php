<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction_module_functions extends CI_Model {

    private $spec_function_per_module = array(
            // 53 => array('after-approval' 	=> array(
            // 										'release-check'			=> 'Release Check',
            // 										)
            // 			)
    );
    private $functions                = array(
        'sender'      => array('before-send-approval' => array(
                'send-approval-request' => 'Send Approval Request',
                'cancel'                => 'Cancel',
                'print'                 => 'Print',
                'track-document'        => 'Track Document'
            ),
            'after-send-approval'  => array(
                'cancel-approval' => 'Cancel & Edit',
                'cancel'          => 'Cancel',
                'print'           => 'Print',
                'track-document'  => 'Track Document'
            ),
            'after-approval'       => array(
                're-open'        => 'Re Open',
                'print'          => 'Print',
                'track-document' => 'Track Document'
            ),
        ),
        'approver'    => array(
            'after-send-approval' => array(
                'approve'        => 'Approve',
                'reject'         => 'Reject',
                'print'          => 'Print',
                'track-document' => 'Track Document'
            ),
            'after-approval'      => array(
                'print'          => 'Print',
                'track-document' => 'Track Document'
            ),
        ),
        'poster'      => array(
            'print' => 'Print',
            'post'  => 'Post'
        ),
        'with-access' => array(
            'after-send-approval' => array(
                'print'          => 'Print',
                'track-document' => 'Track Document'
            )
        ),
    );

    public function __construct() {
        parent::__construct();
    }

    public function get_multi_doc_no_module_functions($table, $doc_tracking_no, $original_doc_no, $primary_key, $status_field, $sender_field, $module_id) {

        $is_sender = $this->check_if_sender($table, $original_doc_no, $primary_key, $sender_field);

        $is_approver = $this->check_if_approver($doc_tracking_no);

        $is_next_approver = $this->check_if_next_approver($doc_tracking_no);

        $is_last_approver = $this->check_if_last_approver($doc_tracking_no);

        $is_sent = $this->check_document_is_sent($table, $original_doc_no, $primary_key, $status_field);

        $is_finished_approval = $this->check_document_is_finished_approval($doc_tracking_no);

        if ($is_sent) {
            if ($is_sender) {

                if ($is_finished_approval) {
                    return $this->functions['sender']['after-approval'];
                } else {

                    return $this->functions['sender']['after-send-approval'];
                }
            } else if ($is_approver) {

                if ($is_next_approver) {

                    return $this->functions['approver']['after-send-approval'];
                } else {

                    return $this->functions['approver']['after-approval'];
                }
            } else {

                return $this->functions['with-access']['after-send-approval'];
            }
        } else {
            if ($is_sender && !$is_finished_approval) {

                return $this->functions['sender']['before-send-approval'];
            } else {

                if ($is_finished_approval && $is_approver) {

                    $function = $this->functions['approver']['after-approval'];
                    if (isset($this->spec_function_per_module[$module_id]['after-approval'])) {
                        $function = array_merge($this->spec_function_per_module[$module_id]['after-approval'], $this->functions['approver']['after-approval']);
                    }

                    return $function;
                } else if ($is_finished_approval && $is_sender) {


                    $function = $this->functions['sender']['after-approval'];
                    if (isset($this->spec_function_per_module[$module_id]['after-approval'])) {
                        $function = array_merge($this->spec_function_per_module[$module_id]['after-approval'], $this->functions['sender']['after-approval']);
                    }

                    return $function;
                } else {
                    return $this->functions['with-access']['after-send-approval'];
                }
            }
        }
    }

    public function get_module_functions($table, $doc_no, $primary_key, $status_field, $sender_field, $module_id) {

        $is_sender = $this->check_if_sender($table, $doc_no, $primary_key, $sender_field);

        $is_approver = $this->check_if_approver($doc_no);

        $is_next_approver = $this->check_if_next_approver($doc_no);

        $is_last_approver = $this->check_if_last_approver($doc_no);

        $is_sent = $this->check_document_is_sent($table, $doc_no, $primary_key, $status_field);

        $is_finished_approval = $this->check_document_is_finished_approval($doc_no);

        if ($is_sent) {
            if ($is_sender) {

                if ($is_finished_approval) {
                    return $this->functions['sender']['after-approval'];
                } else {

                    return $this->functions['sender']['after-send-approval'];
                }
            } else if ($is_approver) {

                if ($is_next_approver) {

                    return $this->functions['approver']['after-send-approval'];
                } else {

                    return $this->functions['approver']['after-approval'];
                }
            } else {

                return $this->functions['with-access']['after-send-approval'];
            }
        } else {
            if ($is_sender && !$is_finished_approval) {

                return $this->functions['sender']['before-send-approval'];
            } else {

                if ($is_finished_approval && $is_approver) {

                    $function = $this->functions['approver']['after-approval'];
                    if (isset($this->spec_function_per_module[$module_id]['after-approval'])) {
                        $function = array_merge($this->spec_function_per_module[$module_id]['after-approval'], $this->functions['approver']['after-approval']);
                    }

                    return $function;
                } else if ($is_finished_approval && $is_sender) {


                    $function = $this->functions['sender']['after-approval'];
                    if (isset($this->spec_function_per_module[$module_id]['after-approval'])) {
                        $function = array_merge($this->spec_function_per_module[$module_id]['after-approval'], $this->functions['sender']['after-approval']);
                    }

                    return $function;
                } else {
                    return $this->functions['with-access']['after-send-approval'];
                }
            }
        }
    }

    public function check_if_last_approver($doc_no) {

        $result = $this->db->select('*')
                ->where(array('DT_DocNo'    => $doc_no,
                    'DT_Approver' => $this->session->userdata('U_FK_Position_id')))
                ->limit(1)
                ->order_by('DT_EntryNo DESC')
                ->get('tblCOM_DocTracking');

        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_if_sender($table, $doc_no, $primary_key, $sender_field) {

        $result = $this->db->select('*')
                ->where(array($primary_key  => $doc_no,
                    $sender_field => $this->session->userdata('U_User_id')))
                ->get($table);
                // print_r($this->db->error());
        if ($result->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_if_approver($doc_no) {

        $result = $this->db->select('*')
                ->where(array('DT_DocNo'    => $doc_no,
                    'DT_Approver' => $this->session->userdata('U_FK_Position_id')))
                ->get('tblCOM_DocTracking');

        if ($result->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_if_next_approver($doc_no) {

        $result = $this->db->select('*')
                ->where(array('DT_DocNo' => $doc_no))
                ->where_not_in('DT_Status', array('Skipped', 'Approved', 'Cancelled', 'Re Opened'))
                ->limit('1')
                ->order_by('DT_EntryNo ASC')
                ->get('tblCOM_DocTracking');

        if ($result->num_rows() > 0) {
            if ($this->session->userdata('U_FK_Position_id') == $result->row_array()['DT_Approver']) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function check_document_is_sent($table, $doc_no, $primary_key, $status_field) {

        $result = $this->db->select('*')
                ->where(array($primary_key => $doc_no))
                ->get($table);

        if ($result->row_array()[$status_field] == 'Pending') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_document_is_finished_approval($doc_no) {
        $result = $this->db->select('*')
                ->where(array('DT_DocNo' => $doc_no))
                ->limit('1')
                ->order_by('DT_EntryNo DESC')
                ->get('tblCOM_DocTracking');

        if ($result->row_array()['DT_Status'] == 'Approved') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_if_poster($docno, $module_id) {
        $this->load->model('app/administration/user_function_model');
        $post_allowed = $this->user_function_model->get_module_function_per_pos_inside(array(
            '"F_FK_Module_id"' => $module_id,
            '"UF_FK_User_id"'  => $this->session->userdata('U_User_id'),
            '"F_FunctionName"' => "Post",
        ));

        return $post_allowed && $this->transaction_module_functions->check_document_is_finished_approval($docno);
    }

}
