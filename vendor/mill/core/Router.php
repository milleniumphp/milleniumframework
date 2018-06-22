<?php

namespace mill\core;

/**
 * default Router Class for url routing
 * @author Yaroslav Palamarchuk
 */
class Router {

    /**
     * get real route
     * @var array
     */
    protected static $route = [];

    /**
     * get all routes
     * @var array
     */
    protected static $routes = [
        '^examples/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'=> ['prefix'=>'examples']
    ];

    /**
     * add another one route
     * @param string $regexp regular expression
     * @param array  $route for adding a new route
     */
    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    /**
     * find needed route in all routes list
     * @param  string $url [description]
     * @return bool      if route exists return true
     */
    public static function matchRoute($url) {
        //loop for routes
        foreach (self::$routes as $pattern => $route) {
            //if route exists
            if (preg_match("#$pattern#i", $url, $matches)) {
                
                //if key name === "controller"...
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                //if route without action
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                //prefix for controllers
                if(!isset($route['prefix'])){
                    $route['prefix'] = '';
                }else{
                    $route['prefix'] .= '\\'; 
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                
                return true;
            }
            
        }
        
        return false;
        
    }

    /**
     * select route
     * @param  string $url select route
     * @return string      if error 404.html returns
     */
    public static function dispatch($url) {
        
        $url = self::removeQueryString($url);
        //if route exists
        if (self::matchRoute($url)) {
            
            //get camelcase name controller[ new-posts => NewPosts ] with namespace
            $controller = '\app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            /**
             * if nor an error page 
             */
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                //get action name[ indexAction ]
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    $errorview = isset($cObj->errorview) ? $cObj->errorview : 'default';
                    $errorlayout = $cObj->layout ?: LAYOUT;
                    if(!DEBUG){
                        $e = new base\ErrorController(404, $errorview, $errorlayout);
                        http_response_code(404);
                        $e->usererror(8,"Page not found");
                    }else{
                        throw new \Exception("Method {$controller} : {$action} not found");
                    }
                    
                }
                return true;
            } else {
                
                if(!DEBUG){
                    $e = new base\ErrorController(404, $errorview, $errorlayout);
                    http_response_code(404);
                    $e->usererror(8,"Page not found");
                }else{
                    throw new \Exception("controller {$controller} not found");
                }
                
            }
        } else {
            http_response_code(404);
            throw new \Exception("Page not found", 404);
        }
        
    }

    /**
     * get guery string first param
     * @param  string $url from which url we must catch params
     * @return string      empty string if not '=' in param
     */
    protected static function removeQueryString($url) {
        if ($url) {
            $params = explode('&', $url, 2);
            if (false == strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
        return $url;
    }

    /**
     * get upperCamelCase name for controller[ new-posts => NewPosts ]
     * @param  string $name from which string
     * @return string       return new edited string 
     */
    public static function upperCamelCase($name) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * get lowerCamelCase name for action[ indexAction ]
     * @param  string $name from which string
     * @return string       return new edited string
     */
    public static function lowerCamelCase($name) {
        return lcfirst(self::upperCamelCase($name));
    }

    /**
     * get all routes for static var[for admins]
     * @return array all routes
     */
    public static function getRoutes() {
        return self::$routes;
    }

    /**
     * get real route for this page
     * @return array real route for this page*
     */
    public static function getRoute() {
        return self::$route;
    }

}
