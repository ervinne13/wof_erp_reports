<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}

if(!function_exists('array_remove_duplicate_value')){
    function array_remove_duplicate_value($array,$value){    
        $result = array();
        $return = array();

        foreach ($array as $key=>$item) {
            if (!array_key_exists($item[$value], $result)) {
                $result[$item[$value]] = $item[$value];
                $return[$key] = $item;
            }
        }
        return $return;
    }
}

if(!function_exists('remove_null_in_array')){
    function remove_null_in_array(&$value){    
        foreach ($value AS $key => $item) {
            if ($item === null) {
                $value[$key] = '';
            }
        }
    }
}

