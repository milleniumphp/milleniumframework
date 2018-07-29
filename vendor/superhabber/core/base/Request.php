<?php
namespace mill\core\base;

/**
 * Request class
 *
 * @author Yaroslav Palamarchuk
 */
class Request {

    public static function get($name) {
        return array_map ( 'htmlspecialchars', filter_input_array($name) ?: []);
    }
    
    public static function file(){
        return array_map( 'htmlspecialchars', $_FILES );
    }

}
