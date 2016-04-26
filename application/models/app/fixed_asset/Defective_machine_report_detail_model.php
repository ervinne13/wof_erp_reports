<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Defective_machine_report_detail_model extends MY_Model {

    protected $header_table = "tblCOM_DMR";
    protected $detail_table = "tblCOM_DMRDetail";

    public function __construct() {
        parent::__construct();
        MY_Model::set_table($this->detail_table);
    }

    public function table_data($data) {
        extract($data);

        $this->db->select(array('DMRD_DMR_DocNo',
            'DMRD_LineNo',
            'DMRD_Date',
            'DMRD_ActionTaken',
            'DMRD_UserID',
            'md5(concat("DMRD_DMR_DocNo","DMRD_LineNo")) as id'
        ));

        if (isset($id)) {
            $this->db->where(array('MD5("DMRD_DMR_DocNo")' => $id));
            $this->id = $id;
        } else if (isset($dmrDocNo)) {
            $this->db->where(array('"DMRD_DMR_DocNo"' => $dmrDocNo));
            $this->docNo = $dmrDocNo;
        }

        if (isset($where)) {
            $this->db->where($where);
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("DMRD_DMR_DocNo" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMRD_LineNo" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMRD_Date" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMRD_ActionTaken" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DMRD_UserID" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
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
            $this->db->order_by($this->detail_table . '.DateCreated DESC');
        }

        $count = $this->db->query($this->db->get_compiled_select($this->detail_table, false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());

//        echo $this->db->last_query();

        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function get_details($id) {

        $where  = array('md5("DMRD_DMR_DocNo")' => $id);
        $fields = (array('DMRD_DMR_DocNo',
            'DMRD_LineNo',
            'DMRD_Date',
            'DMRD_ActionTaken',
            'DMRD_UserID',
            'md5(concat("DMRD_DMR_DocNo","DMRD_LineNo")) as id'
        ));

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function get_details_by_doc_no($doc_no) {
        $where  = array('"DMRD_DMR_DocNo"' => $doc_no);
        $fields = (array('DMRD_DMR_DocNo',
            'DMRD_LineNo',
            'DMRD_Date',
            'DMRD_ActionTaken',
            'DMRD_UserID',
            'md5(concat("DMRD_DMR_DocNo","DMRD_LineNo")) as id'
        ));

        return $this->get_spec_data_array_spec_fields($fields, $where);
    }

    public function record_count() {

        if (isset($this->id)) {
            $condition = array('MD5("DMRD_DMR_DocNo")' => $this->id);
        } else {
            $condition = array('"DMRD_DMR_DocNo' => $this->docNo);
        }

        $result = $this->db->select('COUNT(*)')
                ->where($condition)
                ->get($this->detail_table);

        return $result->row_array()['count'];
    }

}
