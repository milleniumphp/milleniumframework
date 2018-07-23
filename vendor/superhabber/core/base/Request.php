<?php
namespace mill\core\base;

/**
 * Description of Request
 *
 * @author Yaroslav Palamarchuk
 */
class Request {

    public static $post = [];
    public static $get = [];
    public static $requests = [];
    public static $files = [];

    public function __construct() {
        self::$post = $this->make($_POST);
        self::$get = $this->make($_GET);
        self::$files = $this->make($_FILES);
        self::$requests = $this->make($_REQUEST);
    }
    
    public function make($var){
        $m = [];
        foreach ($var as $k => $post) {
            $m[$k] = $this->xss_protect($post);
        }
        return $m;
    }

    public function xss_protect(&$item) {
        if(!is_array($item)){
            return htmlspecialchars($item);
        }
        return $item;  
    }

}
