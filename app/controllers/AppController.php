<?php
namespace app\controllers;

use \mill\core\App;
use \mill\widgets\language\Language;
/**
 * default controller extends base controller
 * if you need functional in all controller just edit this one
 * ! DO NOT EDIT \vendor\core\base\Controller without knowledge of what you are doing
 */
class AppController extends \mill\core\base\Controller{

    public function __construct($route) {
        parent::__construct($route);
        new \app\models\Main;
        App::$bin->setProperty('langs', Language::getLanguages());
        App::$bin->setProperty('lang', Language::getLanguage(App::$bin->getProperty('langs')));
    }

}
