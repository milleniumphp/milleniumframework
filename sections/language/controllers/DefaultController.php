<?php
namespace sections\language\controllers;

class DefaultController extends \app\controllers\AppController{
    
    public function changeAction(){
        $lang = \Mill::$request->get(INPUT_GET)['lang'] ?? null;
        if($lang){
            if(array_key_exists($lang, \mill\core\App::$bin->getProperty('langs'))){
                setcookie('lang', $lang, time() + 3600*24*7, '/');
            }
        }
        redirect();
    }
    
}
