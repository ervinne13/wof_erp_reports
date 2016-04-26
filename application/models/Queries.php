<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queries extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	// echo $this->db->last_query(); # display the query
	
	function get_max($table, $field) {		
		$this->db->select_max($field, 'max');
		$sql = $this->db->get($table);
		
		if($sql->num_rows() > 0) {
			return $sql->row(0);
		} else {
			return false;
		}
	}
	
	function get_data($params) {
		# extracts array
		extract($params);
		
		if(!empty($fields)) {
			$this->db->select($fields);
		}
		
		if(!empty($join)) {
			foreach($join as $j) {
				$this->db->join($j['tbljoin'], $j['onjoin'], 'left');
			}
		}
		
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($wherenull)) {
			$this->db->where($wherenull,null,false);
		}

		if(!empty($where_in)) {
			$this->db->where_in($where_in[0],$where_in[1]);
		}
		
		if(!empty($where_not_in)) {
			$this->db->where_not_in($where_not_in[0],$where_not_in[1]);
		}
		
		if(!empty($like)) {
			foreach($like as $k => $v) {
				$this->db->like($k, $v, 'both');
			}
		}
		
		if(!empty($or_like)) {
			foreach($or_like as $k => $v) {
				$this->db->or_like($k, $v, 'both');
			}
		}

		if(!empty($or_having)){
			$this->db->or_having($or_having);
		}
		if(!empty($havingnull)){
			$this->db->having($havingnull,false); 
		}
		if(!empty($having)){
				$this->db->having($having);
		}
		if(!empty($groupby)) {
			$this->db->group_by($groupby); 
		}
		
		if(!empty($order)) {
			$this->db->order_by($order);
		}
		
		if(!empty($limit)) {
			$this->db->limit($limit, $offset);
		}
		
		// generate FROM TABLE
		$this->db->from($table);
		
		$sql = $this->db->get();
		
		// echo $this->db->last_query();
		
		if($sql->num_rows() > 0) {
			if(!empty($row)) {
				$rs = $sql->row(0);
			} else {
				$rs['rows'] = $this->count_rows($params);
				$rs['data'] = $sql->result_array();

			}
				
			return $rs;
		} else {
			return false;
		}
	}
	
	function total_rows($params){
		extract($params);
		
		if(!empty($fields)) {
			$this->db->select($fields);
		}
		
		if(!empty($join)) {
			foreach($join as $j) {
				$this->db->join($j['tbljoin'], $j['onjoin'], 'left');
			}
		}
		
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($wherenull)) {
			$this->db->where($wherenull,null,false);
		}

		if(!empty($where_in)) {
			$this->db->where_in($where_in[0],$where_in[1]);
		}
		
		if(!empty($where_not_in)) {
			$this->db->where_not_in($where_not_in[0],$where_not_in[1]);
		}
		
		if(!empty($like)) {
			foreach($like as $k => $v) {
				$this->db->like($k, $v, 'both');
			}
		}
		
		if(!empty($or_like)) {
			foreach($or_like as $k => $v) {
				$this->db->or_like($k, $v, 'both');
			}
		}

		if(!empty($groupby)) {
			$this->db->group_by($groupby); 
		}
		if(!empty($order)) {
			$this->db->order_by($order);
		}
		
		// generate FROM TABLE
		$this->db->from($table);
		
		$sql = $this->db->get();
		
		return $sql->num_rows();
	}
	// count rows of the query	
	function count_rows($params) {
		# extracts array
		extract($params);
		
		if(!empty($fields)) {
			$this->db->select($fields);
		}
		
		if(!empty($join)) {
			foreach($join as $j) {
				$this->db->join($j['tbljoin'], $j['onjoin'], 'left');
			}
		}
		
		if(!empty($where)) {
			$this->db->where($where);
		}

		if(!empty($wherenull)) {
			$this->db->where($wherenull,null,false);
		}

		if(!empty($where_in)) {
			$this->db->where_in($where_in[0],$where_in[1]);
		}
		
		if(!empty($where_not_in)) {
			$this->db->where_not_in($where_not_in[0],$where_not_in[1]);
		}
		
		if(!empty($like)) {
			foreach($like as $k => $v) {
				$this->db->like($k, $v, 'both');
			}
		}
		
		if(!empty($or_like)) {
			foreach($or_like as $k => $v) {
				$this->db->or_like($k, $v, 'both');
			}
		}

		if(!empty($or_having)){
			foreach($or_having as $k => $v) {
				$this->db->or_having($k, $v);
			}
		}
		if(!empty($havingnull)){
			$this->db->having($havingnull,false); 
		}
		if(!empty($having)){
			foreach($having as $k => $v) {
				$this->db->having($k, $v);
			}
		}
		if(!empty($groupby)) {
			$this->db->group_by($groupby); 
		}
		if(!empty($order)) {
			$this->db->order_by($order);
		}
		
		// generate FROM TABLE
		$this->db->from($table);
		
		$sql = $this->db->get();
		
		return $sql->num_rows();
	}
	
	function check_if_exist($params) {	
		extract($params);
		
		$exist = false;
		
		if(!empty($uniqfld) && count($uniqfld) > 0) {	
			for($i = 0; $i < count($uniqfld); $i++) {		
				$this->db->or_where($uniqfld[$i], $data[$uniqfld[$i]]);
				if(!empty($dataid)) {
				$this->db->where($tbluid . ' <>', $dataid);
				}
			}
			
			
			$this->db->select($tbluid);
			$sql = $this->db->get($table);

			if($sql->num_rows() > 0) {
				$exist = true;
			}
		}

		return $exist;
	}
	
	function insert($params) {
		extract($params);
		
		$exist = $this->check_if_exist($params);
		
		if($exist == false) {
			$this->db->insert($table, $data);
		
			if($this->db->affected_rows() > 0) {
				return 1;
			} else {
				return 0;
			}
		}else{
			return 'exist';
		}
	}
	
	function update($params) {	
		extract($params);
		
		$exist = $this->check_if_exist($params);
		
		if($exist == false) {
			$this->db->where($tbluid . ' = ', $dataid);
			$this->db->update($table, $data);
			
			if($this->db->affected_rows() > 0) {
				return $dataid;
			} else {
				return 0;
			}
		} else {
			return 'exist';
		}
	}
	
	function delete($params) {	
		extract($params);
		
		$this->db->where($uniqid, $dataid);
		$this->db->delete($table);
		
		if($this->db->affected_rows() > 0) {
			return $dataid;
		} else {
			return 0;
		}
	}
	
}

?>