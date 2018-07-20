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
        $route = Router::getRoute();
        
        if ($work && ($route['prefix'] != 'debug\\')) {

            $query = str_replace('?', '&', ltrim(rtrim($_SERVER['REQUEST_URI'], '/'), '/'));

            self::$data['route'] = $route;
            
            self::$data['debug_db'] = \R::getLogs();

            
            file_put_contents(ROOT . '/tmp/debug/1.log', serialize(self::$data));  
            
        }
        $a = file_get_contents(ROOT . '/tmp/debug/1.log');
        
    }
    
    public static function getDbQueries(){
        return unserialize(file_get_contents(ROOT . '/tmp/debug/1.log'))['debug_db'];
    }

}
