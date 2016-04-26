<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('pre')) {
    function pre($array){

        echo '<pre>' . print_r($array, 1) . '</pre>';

    }
}

