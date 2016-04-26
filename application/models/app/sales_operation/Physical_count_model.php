<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Physical_count_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        MY_Model::set_table("tblINV_PCount");
    }

    public function table_data($data) {

        extract($data);

        $this->db->select(array("PC_DocNo",
                    'DATE("PC_DocDate") as "PC_DocDate"',
                    'PC_Description',
                    'PC_CountDate',
                    'PC_Status',
                    'md5("PC_DocNo") as "id"'))
                ->group_by("tblINV_PCount.PC_DocNo");

        if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("PC_DocDate") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("PC_DocDate") <=' => $queries['date-to']));
        }

        if (isset($queries['search'])) {
            $this->db->group_start();

            $this->db->where(array('LOWER(CAST("PC_DocNo" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("PC_DocDate" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("PC_Description" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("PC_CountDate" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));
            $this->db->or_where(array('LOWER(CAST("PC_Status" as text)) LIKE' => '%' . strtolower($queries['search']) . '%'));

            $this->db->group_end();
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        } else {
            $this->db->order_by('tblINV_PCount.PC_DocNo DESC');
        }

        $count = $this->db->query($this->db->get_compiled_select("tblINV_PCount", false));

        if ($perPage !== 'All') {
            $this->db->limit($perPage, $offset);
        }
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
                ->get("tblINV_PCount");

        return $result->row_array()['count'];
    }

    public function update_pc($where, $data) {

        $details = $data['details'];

        unset($data['details']);
        unset($data['PC_Status']);
        unset($data['type']);
        unset($data['uniqid']);

        // $this->db->trans_begin();

        $status['PC_Status'] = "Open";
        $status['PC_DocDate'] = date("Y-m-d H:i:s",time());
        // $data['test'] = $this->input-post('PCS_ItemType');
        // $data['test1'] = $this->input-post('PCS_SubLocation');

        $this->db->where($where)->update('tblINV_PCount', array_merge($data,$status));    

        $this->db->where(array('md5("PCS_PC_DocNo")' => $where['md5("PC_DocNo"::text)']))
                ->delete('tblINV_PCountSetup');
                
        $this->db->where(array('md5("CS_PC_DocNo")' => $where['md5("PC_DocNo"::text)']))
                ->delete('tblINV_PCountSheet');

        if ($details) {
            foreach ($details as $key => $value) {
            	
                $empty = !array_filter($value);
                if (!empty($value) && !$empty) {                	

					$Counsheet['CS_PC_DocNo']      = $data['PC_DocNo'];
	                $Counsheet['CS_CountSheetNo	'] = $value['PCS_CS_CountSheetNo'];	                        

	                $this->db->insert("tblINV_PCountSheet", add_data($Counsheet));
	                // echo $this->db->last_query();

	                foreach ($value["PCS_SubLocation"] as $subloc) {
                    foreach ($value["PCS_ItemType"] as $itemType) {
                        
                        $pcCountSetup['PCS_PC_DocNo']        = $data['PC_DocNo'];
                        $pcCountSetup['PCS_ItemType']        = $itemType;
                        $pcCountSetup['PCS_SubLocation']     = $subloc;
                        $pcCountSetup['PCS_CS_CountSheetNo'] = $value['PCS_CS_CountSheetNo'];
                        $pcCountSetup['PCS_CS_PC_DocNo']     = $data["PC_DocNo"];

                        $this->db->insert("tblINV_PCountSetup", $pcCountSetup);

                        // echo $this->db->last_query();
                        // print_r($pcCountSetup);
                    }}
                  
                }
            }
        }

        // if ($this->db->trans_status() === FALSE) {
        //     $this->db->trans_rollback();
        //     return 0;
        // } else {
        //     $this->db->trans_commit();
        //     return 1;
        // }
    }

  //    public function get_spec_header($content){
  //       $result = $this->db->select('*')
  //              ->where(array('PC_DocNo' => $content['PCS_PC_DocNo']))
  //              ->get("tblINV_PCount");

  //        print_r($this->db->error());
  //        exit();
  //       return array('rows' => $result->num_rows(),
  //                    'data' => $result->result_array());
  // }

}
