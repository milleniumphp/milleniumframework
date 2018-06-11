<?php
namespace mill\html;

/**
 * Description of Form
 *
 * @author Yaroslav Palamarchuk
 */
class Form {
    
    public static function create($options = []){
        $man = new FormManager();
        $man->start($options);
        return $man;
    }
    
    
    
    
}
