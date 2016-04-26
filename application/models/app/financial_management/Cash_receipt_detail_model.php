<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Cash_receipt_model
 *
 * @author Ervinne Sodusta
 */
class Cash_receipt_detail_model extends MY_Model {

    protected $document_no;

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblACC_CRJDetail");
    }

    public function set_document_no($document_no) {
        $this->document_no = $document_no;
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("*",
                    'md5("CRJD_LineNo"::text) as "id"'))
                ->where(array('md5("CRJD_PFK_DocNo")' => $this->document_no))
                ->limit($perPage, $offset)
                ->order_by("DateCreated DESC")
                ->group_by("tblACC_CRJDetail.CRJD_LineNo,CRJD_PFK_DocNo
                    ,CRJD_AppliesToDocType,CRJD_AppliesToDocNo,CRJD_AppliesToDocDate
                    ,CRJD_AppliesToAmount,CRJD_RemAmount,CRJD_Comment,CreatedBy,DateCreated
                    ,ModifiedBy,DateModified,CRJD_Applied,CRJD_AppliedAmount,CRJD_RemAmount");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("CRJD_AppliesToDocType" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CRJD_AppliesToDocNo" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CRJD_AppliesToDocDate" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CRJD_AppliesToAmount" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CRJD_RemAmount" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("CRJD_Comment" as text)) LIKE'          => '%' . strtolower($queries['search']) . '%'
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
            $this->db->order_by('tblACC_CRJDetail.DateCreated DESC');
        }

        $count = $this->db->query($this->db->get_compiled_select("tblACC_CRJDetail", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());

        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    public function record_count() {
        $result = $this->db->select('COUNT(*)')
                ->get("tblACC_CRJDetail");
        return $result->row_array()['count'];
    }

}
