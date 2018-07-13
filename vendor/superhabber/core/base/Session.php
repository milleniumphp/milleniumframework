<?php
namespace mill\core\base;

/**
 * Description of Session
 *
 * @author Yaroslav Palamarchuk
 */
class Session {
    
    public $data = [];
    
    public $alert = [];
    
    public function __construct() {
        unset($this->data);
        $this->alert = [];
        $this->data = $_SESSION;
    }
    
    public function alert($k, $m){  
        $this->alert[$k] = $m; 
    }
    
    public function data($key){
        return $this->data[$key];
        $_SESSION[$key] = [];
    }
    
    
}
