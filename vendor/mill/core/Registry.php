<?php

namespace mill\core;
/**
 * Registry registers all methods which you need
 * error files in /vendor/mill/core/local/errors 
 * @author Yaroslav Palamarchuk
 */
class Registry {
    
    public static $objects = [];
    protected static $instance;
    public $user;
    public $request;
    public $session;

    protected function __construct() {
        $this->user = new \mill\core\base\User();
        $this->request = new \mill\core\base\Request();
        $this->session = new \mill\core\base\Session();
        require ROOT . '/config/config.php';
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }
    /**
     * create new self class clone
     * @return object
     */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __get($name) {
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    public function __set($name, $object) {
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object;
        }
    }

}
