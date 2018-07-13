<?php
/**
 * like var_dump, but better
 * @param array $var
 */
function debug($var){
    echo '<pre style="font-size:16px;">'.print_r($var, true).'</pre>';
}
/**
 * redirect to page if params, else redirect to main page( / )
 * @param string $http
 */
function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location:$redirect");
    exit;
}
/**
 * delete html tags for secyrity
 * @param string $str
 * @return string
 */
function chars($str){
    return htmlspecialchars($str, ENT_QUOTES);
}
/**
 * password hashing
 * @param string $v password
 * @return string
 */
function hashstring($v){
    return password_hash($v, PASSWORD_DEFAULT);
}
/**
 * translator for real language in App::$bin->getProperty('lang') if isset
 * @param string key 
 */
function __($key){
    echo mill\core\base\Language::get($key);
}