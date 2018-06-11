<?php
function debug($var){
	echo '<pre style="font-size:16px;">'.print_r($var, true).'</pre>';
}
function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location:$redirect");
    exit;
}

function chars($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

function hashstring($v){
    return password_hash($v, PASSWORD_DEFAULT);
}