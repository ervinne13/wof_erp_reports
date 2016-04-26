<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("M_Module_id",
                    "M_Description",
                    "COALESCE(" . '"functions"' . ",'') as functions",
                    "COALESCE(" . '"access"' . ",'') as access"))
                ->join('(SELECT string_agg("F_FunctionName",' . "','" . ') as functions ,"F_FK_Module_id" FROM "tblCOM_Function" GROUP BY "F_FK_Module_id") as a', 'a.F_FK_Module_id = tblCOM_Module.M_Module_id', 'left')
                ->join('(SELECT string_agg("UA_AccessName",' . "','" . ') as access ,"UA_FK_Module_id" FROM "tblCOM_UserAccess" GROUP BY "UA_FK_Module_id") as b', 'b.UA_FK_Module_id = tblCOM_Module.M_Module_id', 'left')
                ->group_by("M_Module_id,a.functions,b.access");

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("M_Module_id" as text)) LIKE'   => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("M_Description" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST(functions as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST(access as text)) LIKE'          => '%' . strtolower($queries['search']) . '%',
            ));
        }


        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $count = $this->db->query($this->db->get_compiled_select("tblCOM_Module", false));

        $this->db->limit($perPage, $offset);

        $result = $this->db->query($this->db->get_compiled_select());


        if ($result->num_rows() > 0) {
            return array('rows'  => $count->num_rows(),
                'count' => $this->record_count("tblCOM_Module"),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
    }

    // public function get_all_data(){
    //  		$result =	$this->db->select(array("M_Module_id",
    //     							    "M_Description",
    //     							    "COALESCE(".'"functions"'.",'') as functions",
    //     							    "COALESCE(".'"access"'.",'') as access"))
    //  							  ->join('(SELECT string_agg("F_FunctionName",'."','".') as functions ,"F_FK_Module_id" FROM "tblCOM_Function" GROUP BY "F_FK_Module_id") as a','a.F_FK_Module_id = tblCOM_Module.M_Module_id','left')
    // 		    		  ->join('(SELECT string_agg("UA_AccessName",'."','".') as access ,"UA_FK_Module_id" FROM "tblCOM_UserAccess" GROUP BY "UA_FK_Module_id") as b','b.UA_FK_Module_id = tblCOM_Module.M_Module_id','left')
    // 					  ->group_by("M_Module_id,a.functions,b.access")
    //    		 			  ->get("tblCOM_Module");
    //    return array('rows' => $result->num_rows(),
    //    		 	 'data' => $result->result_array());
    //  }

    public function get_all_modules() {

        $result = $this->db->select(array("*"))
                ->order_by('"M_Parent","M_Module_id" ASC')
                ->get("tblCOM_Module");
        return array('rows' => $result->num_rows(),
            'data' => $result->result_array());
    }

    public function get_all_data_dropdown() {

        $result = $this->db->select(array("M_Module_id",
                    "M_Description"))
                ->where(array("M_Header !="    => '1',
                    "M_Replicate !=" => '1'))
                ->group_by("M_Module_id")
                ->get("tblCOM_Module");

        return array('rows' => $result->num_rows(),
            'data' => $result->result_array());
    }

}
