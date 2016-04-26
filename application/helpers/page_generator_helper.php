<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_table'))
{
    function generate_table($data=array())
    {	
    	$table = "<table class='table table-striped table-hover table-bordered  table-condensed dynatable' id='".key($data)."'><thead><tr>";
    	foreach ($data[key($data)] as $key => $value) {
    		$sort = isset($value['sorts'])?"data-dynatable-no-sort='true'":"";
    		$table .= "<th data-dynatable-column='".$key."' ".$sort.">".$value['label']."</th>";
    	}
        
    	$table .= "</tr></thead><tbody></tbody></table>";	
    	return $table;
    }   
}

