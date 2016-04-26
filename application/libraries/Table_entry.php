<?php if ( ! defined('BASEPATH')) exit('No direct script Access allowed'); 

/**
 * @author Gregori Napilot
 */

class Table_entry
{
	protected $CI;
	
	protected $config			= array();
	
	protected $rows  			= array(); 
	
	/**
	 * @param string $tableId 
	 * @param array  $config
	*/

	public function __construct(){

		$this->CI = & get_instance();
		$this->CI->load->library('table');

	}


	/**
	 * @param array $config 
	 * @return void
	*/

	public function initializeConfig($config = array()){

		$this->config = $config;

	}

	/**
	 * @param array $row
	 * @return void
	*/

	public function addRow($row){

		array_merge($this->rows,$row);

	}

}