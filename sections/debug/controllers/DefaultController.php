<?php
namespace sections\debug\controllers;

class DefaultController extends \mill\core\base\Controller{
    
    public $layout = false;
    
    public function indexAction() {
        $log = unserialize(file_get_contents(ROOT . '/tmp/debug/1.log'));
        
        $this->set(['log'=>$log]);
    }
    
    public function viewAction(){
        $phpinfo = $this->php_about();
        $get = \Mill::$request->get(INPUT_GET);
        $route = \mill\core\Router::matchRoute(isset($get['route']) ? ltrim($get['route'], '/') : '/');
        
        $log = unserialize(file_get_contents(ROOT . '/tmp/debug/1.log'));
        
        unset($log['debug_server']['PATH']);
                
        $this->set([
            'phpinfo' => $phpinfo,
            'log' => $log,
            'route' => $route,
            
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

}
