<?php
namespace sections\debug\controllers;

class DefaultController extends \mill\core\base\Controller{
    
    public $layout = false;
    
    public function indexAction() {
        
    }
    
    public function viewAction(){
        $phpinfo = $this->php_about();
        $route = \mill\core\Router::matchRoute(isset($_GET['route']) ? ltrim($_GET['route'], '/') : '/');
        
//        if(!empty($route['prefix'])){
//            $logger = '\sections\\' . $route['prefix'] . $route['controller'] . 'Controller';
//        }else{
//            $logger = '\app\controllers\\' . $route['controller'] . 'Controller';
//        }
//        $c = new $logger($route);
//        
//        debug($c->debug_queries);
        
                
        $this->set([
            'phpinfo' => $phpinfo,
            'log' => \R::debug(true),
            'route' => $route
        ]);
        
    }
    
    public function php_about(){
        ob_start();
        phpinfo();
        $pinfo = ob_get_contents();
        ob_end_clean();
        $pinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo);
        return '<style>' . file_get_contents('assets/mill/system/css/debugbar/phpinfo.css') . '</style>'.$pinfo;
    }

    /*
     * WAIT FOR UPDATES
    */
    
}
