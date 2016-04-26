<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_approval_model extends MY_Model {

    private $prefixes = array('L');

    public function __construct() {
        parent::__construct();
    }

    public function table_data($data) {

        extract($data);

        $locations = "'" . implode("','", array_column($this->session->userdata('location'), 'SP_StoreID')) . "'";
        $this->db->select(array('*', 'md5("DT_EntryNo"::text) as id', '"P_Position" as "Position"'))
                ->where(array('DT_Approver' => $this->session->userdata('U_FK_Position_id'),
                    'DT_Status'   => 'Pending',
                ))
                ->where('(("prevdoc" != "DT_DocNo" OR "prestat" != ' . "'Pending'" . ') OR ("prestat" IS NULL AND "prevdoc" IS NULL))')
                ->where('(("DT_Location" IN (' . $locations . ')) OR ("DT_Location" = ' . "''" . '))');
        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("DT_DocNo" as text)) LIKE'     => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DT_Sender" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("P_Position" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DT_Status" as text)) LIKE'    => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DT_Location" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DT_EntryDate" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
            ));
        }


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('DT_EntryNo ASC');
        }


        $count = $this->db->query($this->db->get_compiled_select('(SELECT *, LAG("DT_Status") OVER (ORDER BY "DT_EntryNo" ASC) as prestat ,LAG("DT_DocNo") OVER (ORDER BY "DT_EntryNo" ASC) as prevdoc
																   FROM "tblCOM_DocTracking"
																   LEFT JOIN "tblCOM_Position" ON "tblCOM_Position"."P_Position_id" = "tblCOM_DocTracking"."DT_Approver" 
																   ) as a', false));
        if(isset($perPage) && isset($offset)){
            $this->db->limit($perPage, $offset);
        }
            

        $result = $this->db->query($this->db->get_compiled_select());

        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $this->join_line_based_approval_docs($result->result_array()));
        } else {
            return FALSE;
        }
    }

    public function join_line_based_approval_docs($docs) {

        $joined_docs  = array();
        $grouped_docs = array();

        foreach ($docs AS $doc) {
            $splitted_doc_no = explode("-", $doc["DT_DocNo"]);

            //  has more than 1 "-"
            if (count($splitted_doc_no) > 2) {
                $doc_no                = $splitted_doc_no[0] . '-' . $splitted_doc_no[1];
                $grouped_docs[$doc_no] = $doc;
                $grouped_docs[$doc_no]["DT_DocNo"] = $doc_no;
            } else {
                array_push($joined_docs, $doc);
            }
        }

        foreach ($grouped_docs AS $group_doc) {
            array_push($joined_docs, $group_doc);
        }

        return $joined_docs;
    }

    public function record_count() {
        $locations = "'" . implode("','", array_column($this->session->userdata('location'), 'SP_StoreID')) . "'";
        $result    = $this->db->select('COUNT(*)')
                ->where(array('DT_Approver' => $this->session->userdata('U_FK_Position_id'),
                    'DT_Status'   => 'Pending',
                ))
                ->where('(("prevdoc" != "DT_DocNo" OR "prestat" != ' . "'Pending'" . ') OR ("prestat" IS NULL AND "prevdoc" IS NULL))')
                ->where('(("DT_Location" IN (' . $locations . ')) OR ("DT_Location" = ' . "''" . '))')
                ->get('(SELECT *, LAG("DT_Status") OVER (ORDER BY "DT_EntryNo" ASC) as prestat ,LAG("DT_DocNo") OVER (ORDER BY "DT_EntryNo" ASC) as prevdoc
							   FROM "tblCOM_DocTracking"
							   LEFT JOIN "tblCOM_Position" ON "tblCOM_Position"."P_Position_id" = "tblCOM_DocTracking"."DT_Approver" 
							   ) as a');

        return $result->row_array()['count'];
    }

    public function update_data($where, $data) {

        return $this->db->where($where)
                        ->update("tblCOM_DocTracking", $data);
    }

    private function get_higher_position($id, $return = array()) {

        $sender   = $this->get_approver_id(array('P_Position_id' => $id));
        $approver = $sender['P_Parent'];

        if ($approver != "") {
            $return[floor($approver / 1000) * 1000] = $this->get_approver_id(array('P_Position_id' => $approver));
            return $this->get_higher_position($approver, $return);
        } else {
            return $return;
        }
    }

    private function get_approver_id($where) {
        $result = $this->db->select('*')
                ->where($where)
                ->get("tblCOM_Position");
        return $result->row_array();
    }

    private function get_spec_approvers($where, $sequence) {

        $sequence = $sequence ? 'AND "AS_Sequence" > ' . $sequence['AS_Sequence'] : '';

        $result = $this->db->select(array('"NS_Id" as id',
                    "NS_Id",
                    "M_Description",
                    '(select json_agg(d)
      								FROM (
									        SELECT "AS_FK_Position_id","AS_Sequence","AS_Amount","AS_Unlimited","AS_Required","AS_Amount"
									        FROM "tblCOM_ApprovalSetup" d
											LEFT JOIN "tblCOM_Position" ON "P_Position_id" = "AS_FK_Position_id"
        									where "AS_FK_NS_id"="NS_Id" ' . $sequence . '
											ORDER BY "AS_Sequence"
      									 ) d
    							 ) as setup'))
                ->join("tblCOM_Module", 'M_Module_id = NS_FK_Module_id', 'left')
                ->where($where)
                ->group_by('NS_Id,M_Description')
                ->get("tblCOM_NoSeries");

        return $result->row_array();
    }

    private function get_approver_sequence_per_position($where) {

        $result = $this->db->select('*')
                ->where($where)
                ->get("tblCOM_ApprovalSetup");

        return $result->row_array();
    }

    private function check_document_status($doc_no) {

        $result = $this->db->select('*')
                ->where(array('DT_DocNo' => $doc_no))
                ->limit(1)
                ->order_by('DT_EntryNo DESC')
                ->get('tblCOM_DocTracking');

        if (!$result->row_array() || $result->row_array()['DT_Status'] == 'Approved') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function send_approval($data, $amount, $ns_id = null) {

        if (!$ns_id) {
            $ns_id = $data['DT_FK_NSCode'];
        } else {
            $data['DT_FK_NSCode'] = $ns_id;
        }

        $special_approver = $this->get_higher_position($this->session->userdata('U_FK_Position_id'));

        $sender_position = $this->session->userdata('U_FK_Position_id');

        $sender_sequence = $this->get_approver_sequence_per_position(array("AS_FK_NS_id" => $ns_id, 'AS_FK_Position_id' => $sender_position));

        $approvers = $this->get_spec_approvers(array("NS_Id" => $ns_id), $sender_sequence);

        $approvers = json_decode($approvers['setup']);

        $default = array(
            'DT_Status'    => 'Pending',
            'DT_Sender'    => $this->session->userdata('U_User_id'),
            'DT_EntryDate' => date("Y-m-d H:i:s", time()),
        );
        $marker  = 0;

        if ($amount !== 0 || $amount === NULL) {
            if (count($approvers) > 0) {

                foreach ($approvers as $key => $value) {

                    $result = array_merge($default, $data);

                    if (in_array($value->AS_FK_Position_id, array('2000', '3000', '4000', '5000', '6000', '7000', '8000')) && $sender_position < $value->AS_FK_Position_id) {
                        $result['DT_Approver'] = $special_approver[$value->AS_FK_Position_id]['P_Position_id'];
                    } else {
                        $result['DT_Approver'] = $value->AS_FK_Position_id;
                    }

                    $result['DT_Unlimited'] = $value->AS_Unlimited;
                    $result['DT_Required']  = $value->AS_Required;
                    $result['DT_Amount']    = $value->AS_Amount;


                    if ($amount >= $result['DT_Amount'] && $marker == 0) {

                        $this->db->insert('tblCOM_DocTracking', $result);
                    } else {
                        $marker = 1;
                        if ($result['DT_Required'] == '1' || $result['DT_Amount'] > $amount) {

                            $this->db->insert('tblCOM_DocTracking', $result);
                        } else {
                            continue;
                        }
                    }
                }
                return 1;
            } else {
                return 0;
            }
        } else {
            die("Can't send approval with 0 amount!");
        }
    }

    private function update_to_open($doc_no, $table, $primary_key, $status_key) {
        $this->db->where(array($primary_key => $doc_no))
                ->update($table, array($status_key => 'Open'));
    }

    public function reject_doc_with_separate_no($doc_tracking_no, $original_doc_no, $table, $primary_key, $status_key, $remarks = '') {

        $this->db->trans_start();

        $this->db->where(' "DT_EntryNo" = (SELECT "DT_EntryNo" FROM "tblCOM_DocTracking" 
  				 			WHERE "DT_Approver" = ' . "'" . $this->session->userdata("U_FK_Position_id") . "'" . ' AND
  				 			"DT_Status" 		= \'Pending\' AND
  				 			"DT_DocNo" 			= ' . "'" . $doc_tracking_no . "'" . '
  				 			LIMIT 1) '
                )
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Rejected',
                    'DT_Remarks'      => $remarks,
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        $this->db->where(array('DT_DocNo'  => $doc_tracking_no,
                    'DT_Status' => 'Pending'))
                ->where(' "DT_EntryNo" > (SELECT "DT_EntryNo" FROM "tblCOM_DocTracking" 
  				 			WHERE "DT_Approver" = ' . "'" . $this->session->userdata('U_FK_Position_id') . "'" . '
  				 			LIMIT 1) '
                )
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Skipped',
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        $this->update_to_open($original_doc_no, $table, $primary_key, $status_key);

        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function reject($doc_no, $table, $primary_key, $status_key, $remarks = '') {

        $this->db->trans_start();

        $this->db->where(' "DT_EntryNo" = (SELECT "DT_EntryNo" FROM "tblCOM_DocTracking" 
  				 			WHERE "DT_Approver" = ' . "'" . $this->session->userdata("U_FK_Position_id") . "'" . ' AND
  				 			"DT_Status" 		= \'Pending\' AND
  				 			"DT_DocNo" 			= ' . "'" . $doc_no . "'" . '
  				 			LIMIT 1) '
                )
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Rejected',
                    'DT_Remarks'      => $remarks,
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        $this->db->where(array('DT_DocNo'  => $doc_no,
                    'DT_Status' => 'Pending'))
                ->where(' "DT_EntryNo" > (SELECT "DT_EntryNo" FROM "tblCOM_DocTracking" 
  				 			WHERE "DT_Approver" = ' . "'" . $this->session->userdata('U_FK_Position_id') . "'" . '
  				 			LIMIT 1) '
                )
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Skipped',
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        $this->update_to_open($doc_no, $table, $primary_key, $status_key);

        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cancel_approval_doc_with_separate_no($doc_tracking_no, $original_doc_no, $table, $primary_key, $status_key) {

        $this->db->trans_start();

        $this->db->where(array('DT_DocNo'  => $doc_tracking_no,
                    'DT_Status' => 'Pending'))
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Revised',
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        $this->update_to_open($original_doc_no, $table, $primary_key, $status_key);

        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cancel_approval($doc_no, $table, $primary_key, $status_key) {

        $this->db->trans_start();

        $this->db->where(array('DT_DocNo'  => $doc_no,
                    'DT_Status' => 'Pending'))
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Revised',
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        $this->update_to_open($doc_no, $table, $primary_key, $status_key);

        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function re_open($doc_no, $table, $primary_key, $status_key, $remarks, $prefix = null) {

        $this->db->trans_start();

        MY_Model::set_table('tblCOM_DocTracking');

        $result = $this->get_spec_data_row(array('DT_DocNo' => $doc_no));

        unset($result['DT_EntryNo']);
        $result['DT_Status']       = 'Re Opened';
        $result['DT_DateApproved'] = date("Y-m-d H:i:s", time());
        $result['DT_Remarks']      = $remarks;
        $result['DT_Approver']     = '';
        $result['DT_ApprovedBy']   = '';
        $result['DT_TargetURL']    = '';
        $result['DT_Viewed']       = NULL;

        $this->db->insert('tblCOM_DocTracking', $result);

        if ($prefix && in_array(explode('-', $doc_no)[0], $this->prefixes)) {
            $doc_no = str_replace($prefix . '-', '', $doc_no);
        }

        $this->update_to_open($doc_no, $table, $primary_key, $status_key);
    


        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function get_fields_to_set_null($table, $status_field) {

        $query = "SELECT a.attname as name
				FROM pg_attribute a 
				JOIN pg_class pgc ON pgc.oid = a.attrelid
				LEFT JOIN pg_index i ON 
				    (pgc.oid = i.indrelid AND i.indkey[0] = a.attnum)
				LEFT JOIN pg_description com on 
				    (pgc.oid = com.objoid AND a.attnum = com.objsubid)
				LEFT JOIN pg_attrdef def ON 
				    (a.attrelid = def.adrelid AND a.attnum = def.adnum)
				WHERE a.attnum > 0 AND pgc.oid = a.attrelid
				AND pg_table_is_visible(pgc.oid)
				AND NOT a.attisdropped
				AND coalesce(i.indisprimary,false) != 'TRUE' 
				AND a.attname != " . "'" . $status_field . "'" . " 
				AND pgc.relname = " . "'" . $table . "'" . " 
				ORDER BY a.attnum;";

        $result = $this->db->query($query);
        return array_map(array($this, '_map_field_to_null'), array_flip(array_column($result->result_array(), 'name')));
    }

    private function _map_field_to_null(&$value) {
        $value = NULL;
    }

    public function cancel($doc_no, $table, $status_field, $primary_key, $subtable = NULL, $lookup_key = NULL) {
        $this->db->trans_begin();

        $this->db->where(array($primary_key => $doc_no))
                ->update($table, array($status_field => 'Cancelled'));
        
        // ->update($table,array_merge($this->get_fields_to_set_null($table,$status_field),array($status_field=>'Canceled')));
        // if($subtable){
        //  $this->db->where(array($lookup_key => $doc_no))
        //           ->delete($subtable);
        // }

        $this->db->where(array('DT_DocNo'  => $doc_no,
                    'DT_Status' => 'Open'))
                ->update("tblCOM_DocTracking", array('DT_Status' => "Cancelled"));
  
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    private function update_doc_to_approve($table, $primary_key, $doc_no, $status_key) {

        $this->db->where(array($primary_key => $doc_no))
                ->update($table, array($status_key => 'Approved'));
    }

    public function approve_doc_with_separate_no($doc_tracking_no, $original_doc_no, $table, $primary_key, $status_key) {
        $this->db->trans_start();

        $this->db->where(' "DT_EntryNo" = (SELECT "DT_EntryNo" FROM "tblCOM_DocTracking" 
  				 			WHERE "DT_Approver" = ' . "'" . $this->session->userdata('U_FK_Position_id') . "'" . ' 
  				 			AND "DT_Status" = ' . "'" . 'Pending' . "'" . '
  				 			AND "DT_DocNo"  = ' . "'" . $doc_tracking_no . "'" . '
  				 			ORDER BY "DT_EntryNo" ASC 
  				 			LIMIT 1)'
                )
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Approved',
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        if ($this->check_document_status($doc_tracking_no)) {
            $this->update_doc_to_approve($table, $primary_key, $original_doc_no, $status_key);
        }


        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function approve($doc_no, $table, $primary_key, $status_key) {

        $this->db->trans_start();

        $this->db->where(' "DT_EntryNo" = (SELECT "DT_EntryNo" FROM "tblCOM_DocTracking" 
  				 			WHERE "DT_Approver" = ' . "'" . $this->session->userdata('U_FK_Position_id') . "'" . ' 
  				 			AND "DT_Status" = ' . "'" . 'Pending' . "'" . '
  				 			AND "DT_DocNo"  = ' . "'" . $doc_no . "'" . '
  				 			ORDER BY "DT_EntryNo" ASC 
  				 			LIMIT 1)'
                )
                ->update('tblCOM_DocTracking', array('DT_Status'       => 'Approved',
                    'DT_ApprovedBy'   => $this->session->userdata('U_User_id'),
                    'DT_DateApproved' => date("Y-m-d H:i:s", time())));

        if ($this->check_document_status($doc_no)) {
            $this->update_doc_to_approve($table, $primary_key, $doc_no, $status_key);


            // if($callback){
            // 	$instance = $callback[0];
            // 		$instance->$callback[1](isset($callback[2])?implode(',', $callback[2]):null);
            // }
        }


        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
