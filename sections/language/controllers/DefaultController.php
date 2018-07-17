<?php
namespace sections\language\controllers;

class DefaultController extends \app\controllers\AppController{
    
    public function changeAction(){
        $lang = !empty($_GET['lang']) ? $_GET['lang'] : null;
        if($lang){
            if(array_key_exists($lang, \mill\core\App::$bin->getProperty('langs'))){
                setcookie('lang', $lang, time() + 3600*24*7, '/');
            }
        }
        redirect();
    }
    
}
