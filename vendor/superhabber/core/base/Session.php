<?php
namespace mill\core\base;

/**
 * Description of Session
 *
 * @author Yaroslav Palamarchuk
 */
class Session {
    
    public $data = [];
    
    public function __construct() {
        unset($this->data);
        $this->data = $_SESSION;
    }
    
    public function data($key){
        return $this->data[$key];
        $_SESSION[$key] = [];
    }
    
}
