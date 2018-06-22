<?php
namespace app\controllers;

use \mill\core\base\Controller;
/**
 * default controller extends base controller
 * if you need functional in all controller just edit this one
 * ! DO NOT EDIT \vendor\core\base\Controller without knowledge of what you are doing
 */
class AppController extends Controller{

    
    public function __construct($route) {
        parent::__construct($route);
        new \app\models\Main;
    }
   
    
}