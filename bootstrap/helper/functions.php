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

function json_return_data($data,$state,$message = null,$code = 200)
{
    $result = [
        'status' => $state,
        'data' => $data,
        'message' => $message,
        'code' => $code
    ];
    return json_encode($result);
}

function combobox($source, $field_id, $field_name, $selected=null,$multiple=false)
{
    $option = '';
    foreach($source as $item){
        if(is_object($item)){
            if($item->{$field_id} == $selected){
                if(is_array($field_name)){
                    $option .= '<option value="'.$item->{$field_id}.'" selected>'.$item->{$field_name[0]}.' - '.$item->{$field_name[1]}.'</option>';
                }else $option .= '<option value="'.$item->{$field_id}.'" selected>'.$item->{$field_name}.'</option>';
            }else {
                if(is_array($field_name)){
                    $option .= '<option value="'.$item->{$field_id}.'">'.$item->{$field_name[0]}.' - '.$item->{$field_name[1]}.'</option>';
                }else $option .= '<option value="'.$item->{$field_id}.'">'.$item->{$field_name}.'</option>';
            } 
           
        }elseif(is_array($item)){
            if($item[$field_id] == $selected){
                if(is_array($field_name)){
                    $option .= '<option value="'.$item[$field_id].'" selected>'.$item[$field_name[0]].' - '.$item[$field_name[1]].'</option>';
                }else $option .= '<option value="'.$item[$field_id].'" selected>'.$item[$field_name].'</option>';
            }else  {
                if(is_array($field_name)){
                    $option .= '<option value="'.$item[$field_id].'">'.$item[$field_name[0]].' - '.$item[$field_name[1]].'</option>';
                }else $option .= '<option value="'.$item[$field_id].'">'.$item[$field_name].'</option>';
            }
           
        }else continue;
        
    }
    return $option;   
}