<?php
namespace mill\html;

/**
 * Description of Form
 * Form class for standart simple forms
 * @author Yaroslav Palamarchuk
 */
class Form {
    
    public static function create($options = []){
        $man = new FormManager();
        $man->start($options);
        return $man;
    }
    
    
    
    
}
