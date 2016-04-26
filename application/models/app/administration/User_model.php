<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends My_Model {

  public function __construct()
    {
        parent::__construct();
        MY_Model::set_table("tblCOM_User");
    }


  public function table_data($data){
		
		extract($data);

	    $this->db->select(array("U_User_id",
            	    						'md5("U_User_id") as "id" ',
            	    						"U_Username",
            	    						"pos.P_Position  as ".'"Position"'." ",
            								  '(CASE WHEN "U_Status" = '."'1'".' THEN '."'Active'".' WHEN "U_Status" = '."'0'".' THEN '."'Inactive'".' END) as "U_Status"'))
				 ->join('tblCOM_Position as pos','pos.P_Position_id = tblCOM_User.U_FK_Position_id','left')
				 ->group_by("tblCOM_User.U_User_id,P_Position_id");

		if(isset($queries['search'])){
			$this->db->or_having(array(
										'LOWER(CAST("U_User_id" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("U_Username" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CAST("pos"."P_Position" as text)) LIKE' => '%'.strtolower($queries['search']).'%',
										'LOWER(CASE WHEN "U_Status" = '."'1'".' THEN '."'Active'".' WHEN "U_Status" = '."'0'".' THEN '."'Inactive'".' END) LIKE' => '%'.strtolower($queries['search']).'%'
										));
		}


		if(isset($sorts)){
			$res = array();
			foreach ($sorts as $key => $value) {
				$order = $value == 1 ? "ASC" : "DESC";
				array_push($res,  $key." ".$order);
			}
			$this->db->order_by(implode(",", $res));
		}else{
			$this->db->order_by("tblCOM_User.U_User_id ASC");
		}

		$count = $this->db->query($this->db->get_compiled_select("tblCOM_User",false));
		//echo $this->db->last_query();
		$this->db->limit($perPage,$offset);

		$result = $this->db->query($this->db->get_compiled_select());


		if($result->num_rows()>0){
			return	array('rows' => $count->num_rows(),
						        'count'=> $this->record_count("tblCOM_User"),
					  	      'data' => $result->result_array());
		}else{
			return FALSE;
		}
  }
  
  public function get_spec_data_profile($id){
    $result = $this->db->select(array('U_User_id','P_Position','U_Username'))
                       ->join('tblCOM_Position','tblCOM_Position.P_Position_id = tblCOM_User.U_FK_Position_id','left')
                       ->where(array('U_User_id'=>$id))
                       ->get("tblCOM_User");

       return $result->row_array();
  }

  public function add_data($data){

    $default = isset($data['radio'])?$data['radio']:null;
  	$loc = $data['U_FK_Location_id'];
  	unset($data['U_FK_Location_id'],$data['radio']);

  	$this->db->trans_start();
  	$this->db->insert('tblCOM_User',add_data($data));
  	foreach ($loc as $key => $value) {
  			$this->db->insert('tblCOM_CompanyAccess',add_data(array('CA_FK_Location_id'=>$value,'CA_FK_User_id'=>$data['U_User_id'])));
  	}
    
    if($default){
    $this->db->where(array('CA_FK_Location_id'=>$default,'CA_FK_User_id'=>$data['U_User_id']))
             ->update('tblCOM_CompanyAccess',array('CA_DefaultLocation' => '1'));
    }

  	$this->db->trans_complete();

  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }
 
  public function update_main_data($where,$data){
	  
    $this->db->trans_start();
    $default =  isset($data['user']['radio']) ? $data['user']['radio']:NULL;

      
    unset($data['user']['radio']);
	  $this->db->where($where)
  			 ->update('tblCOM_User',update_data($data['user']));

  	foreach ($data['delete'] as $key => $value) {
  		$this->db->where(array('md5("CA_FK_User_id")' => $where['md5("U_User_id")']))
  				 ->where(array('CA_FK_Location_id' => $value))
  				 ->delete("tblCOM_CompanyAccess");
  	}

  	foreach ($data['add'] as $key => $value) {
  		$this->db->insert("tblCOM_CompanyAccess",add_data(array('CA_FK_Location_id' => $value,'CA_FK_User_id' => $data['user']['U_User_id'])));
  	}
  	
    if($default){
    $this->db->where(array('CA_FK_Location_id'=>$default,'CA_FK_User_id'=>$data['user']['U_User_id']))
            ->update('tblCOM_CompanyAccess',array('CA_DefaultLocation' => '1'));

    $this->db->where(array('CA_FK_Location_id !='=>$default,'CA_FK_User_id'=>$data['user']['U_User_id']))
            ->update('tblCOM_CompanyAccess',array('CA_DefaultLocation' => '0'));
  	}
    
  	$this->db->trans_complete();
  	
  	if($this->db->affected_rows() > 0){
  		return 1;
  	}else{
  		return 0;
  	}

  }

}
