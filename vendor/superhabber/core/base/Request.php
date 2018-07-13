<?php
namespace mill\core\base;

/**
 * Description of Request
 *
 * @author Yaroslav Palamarchuk
 */
class Request {

    public $post = [];
    public $get = [];
    public $files = [];

    public function __construct() {
        $this->post = $this->make($_POST);
        $this->get = $this->make($_GET);
        $this->files = $this->make($_FILES);
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
