<?php 


if(!function_exists('format_date')){
    function format_date($date){
        return date('d M Y', strtotime($date));
    }
}


if(!function_exists('make_keyword')){
    function make_keyword($title){
        // $keyword = explode(" ",$title);
        // return implode(",",$keyword);

       return str_replace(" ",",",$title);
    }
}

if(!function_exists('text_short')){
    function text_short($data,$maxLength){
        return substr($data, 0, $maxLength);
    }
}



?>
