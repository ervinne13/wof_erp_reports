<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispensed_redemption_tickets_model extends MY_Model 
 {

  // private $id = NULL;
  
  public function __construct()
    {
    	
        parent::__construct();
        MY_Model::set_table("tblINV_Dispensed");
    }

  public function table_data($data)
  {
		
		extract($data);

        $this->db->select(array(
                    'to_char("DI_DocDate", \'mm/dd/yyyy\') as "DI_DocDate" ',
                    'DI_DocNo',
                    'DI_Location',
                    'DI_Period',
                    'DI_WeekNo',
                    'DI_Company',
                    'DI_Status',
                    'MD5("DI_DocNo") AS id'))
                ->order_by("DateCreated DESC")
                ->group_by("tblINV_Dispensed.DI_DocNo");




		// if(isset($id)){
		// 	$this->db->where(array('MD5("DI_DocNo")'=>$id));
		// 	$this->id = $id;
		// }

		if (isset($queries['date-from'])) {
            $this->db->where(array('DATE("DI_DocDate") >=' => $queries['date-from']));
        }

        if (isset($queries['date-to'])) {
            $this->db->where(array('DATE("DI_DocDate") <=' => $queries['date-to']));
        }

        if (isset($queries['search'])) {
            $this->db->or_having(array(
                'LOWER(CAST("DI_DocDate" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DI_DocNo" as text)) LIKE'         => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DI_Location" as text)) LIKE'  => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DI_Period" as text)) LIKE'       => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DI_WeekNo" as text)) LIKE'      => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DI_Company" as text)) LIKE' => '%' . strtolower($queries['search']) . '%',
                'LOWER(CAST("DI_Status" as text)) LIKE'        => '%' . strtolower($queries['search']) . '%'));
        }

        if (isset($sorts)) {
            $res = array();
            foreach ($sorts as $key => $value) {
                $order = $value == 1 ? "ASC" : "DESC";
                array_push($res, $key . " " . $order);
            }
            $this->db->order_by(implode(",", $res));
        }

        $result = $this->db->get("tblINV_Dispensed");

        if ($result->num_rows() > 0) {
            return array(
                'rows'  => $result->num_rows(),
                'count' => $result->num_rows(),
                'data'  => $result->result_array());
        } else {
            return FALSE;
        }
  }




  	public function record_count()
  	{
		$result =	$this->db->select('COUNT(*)')
 		 					 ->get("tblINV_Dispensed");

	    return $result->row_array()['count'];
  	}
    


 //  	}
}
