<?php
namespace mill\core;
use mill\core\Router;
/**
 * @author Yaroslav Palamarchuk
 */
class Logger {
    
    public static $data = [];
    
    public function __construct($work) {
        if(DEBUGBAR){
            $this->debug($work);
        }
    }
    
    public function debug($work) {
        $route = Router::matchRoute(App::$uri);
        
        if ($work && ($route['prefix'] != 'debug\\')) {
            
            $name = substr(Props::getSetting('app')['_csrf'], 0, 8);

            self::$data['debug_route'] = $route;
            
            self::$data['debug_query'] = App::$uri ?: '/';
            
            self::$data['debug_db'] = \R::getLogs();
            
            self::$data['debug_requests'] = $_REQUEST;
            
            self::$data['debug_post'] = \Mill::$request->get(INPUT_POST);
            
            self::$data['debug_get'] = \Mill::$request->get(INPUT_GET);
            
            self::$data['debug_server'] = $_SERVER;
            
            self::$data['user'] = \Mill::$user->property();

            
            file_put_contents(ROOT . '/tmp/debug/1.log', serialize(self::$data));  
            
            $a = file_get_contents(ROOT . '/tmp/debug/1.log');

            
        }
        
        
    }
    
    public static function getDbQueries(){
        return unserialize(file_get_contents(ROOT . '/tmp/debug/1.log'))['debug_db'];
    }

}
