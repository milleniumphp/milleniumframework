<?php

namespace mill\core\base;

use app\models\Main;

/**
 * @author Yaroslav Palamarchuk
 */
abstract class Controller {

    /**
     * for route
     * @var $route string
     * */
    public $route = [];

    /**
     * for view file[without .php]
     * @var $view string
     * */
    public $view;

    /**
     * for real layout file[path in views/layouts]
     * @var $layout string
     * */
    public $layout;

    /**
     * for variables from controller to view
     * @var $vars array
     * */
    public $vars = [];

    /**
     *
     * @var array metatags for page[title, description, keywords]
     */
    public $metatags = [
        'title' => '', 
        'description' => '', 
        'keywords' => ''
    ];
    
    public $request;
    public $session;

    /**
     * for variables from controller to view
     * @param array $route for real routes
     * */
    public function __construct($route) {
        new Main;
        $this->route = $route ?: \mill\core\Router::getRoute();
        $this->view = $route['action'];

        $this->request = \mill\core\App::$app->request;
        $this->session = \mill\core\App::$app->session;
    }

    /**
     * render view
     * */
    public function getView() {
        //create new View object
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars, $this->metatags);
    }

    /**
     * make variables 
     * @param array $vars variables
     */
    public function set($vars) {
        $this->vars = $vars;
    }

    /**
     * check is ajax
     * @return bool 
     */
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

}
