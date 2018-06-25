<?php


namespace mill\core\console;

/**
 * Description of Console Handler Class
 * class has other classes and calls it if you need from console
 * @author Yaroslav Palamarchuk
 */
class Handler {
    
    /**
     * name of class which is using
     * @var string
     */
    public $className;
    
    /**
     * default console classes
     * @var array
     */
    public $classes = [
        'migration'=>'\mill\core\migrations\Migration',
        'examples'=>'\mill\core\console\Examples',
        'start'=>'\mill\core\console\Start'
    ];
    
    public function __construct($argv) {
        $this->className = $argv[1];
        
        foreach($this->classes as $key => $class){
            if($this->className == $key && class_exists($class)){
                $c = new $class($argv);
                $method = $argv[2];
                if(method_exists($c, $method)) $c->$method();
            }
        }
 
    }
    
    
    
    
}
