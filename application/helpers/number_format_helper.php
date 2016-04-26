<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('numeric')) {
    function numeric($num) {
       return number_format($num,2,'.',',');
    }
}

if (! function_exists('format')) {
    function format($date) {

		if($date){
	    	$date = date_create($date);	
	       	return date_format($date,'m/d/Y');
    	}
    }
}

if (! function_exists('format_datetime')) {
    function format_datetime($date) {

        if($date){
        	$date = date_create($date);	
            return date_format($date,'m/d/Y H:i');
        }
        
    }
}


