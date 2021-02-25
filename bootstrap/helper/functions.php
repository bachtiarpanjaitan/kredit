<?php

function convert_master_to_object($source){
    if(!is_array($source)) return null;
    $array_object = [];
    foreach($source as $key => $value){
        $object = new stdClass();
        $object->value = remove_snake_case($key);
        $object->key = $value;
        array_push($array_object,$object);
    }
    return $array_object;
}

function convert_master_to_object_2($source){
    if(!is_array($source)) return null;
    $array_object = [];
    foreach($source as $key => $value){
        $object = new stdClass();
        $object->value = $value;
        $object->key = remove_snake_case($key);
        $array_object[(int) $value['id']] = $object;
    }
    return $array_object;
}

function remove_snake_case($string,$toappercase = false){
    $result = "";
    if(empty($string)) return "";
    $str_arr = explode('_',$string);
    foreach($str_arr as $str){
        $result .= $toappercase == true ? strtoupper($str):$str;
        $result .= " ";
    }
    return $result;
}