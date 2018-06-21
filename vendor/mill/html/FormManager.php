<?php
namespace mill\html;

/**
 * Description of FormManager
 *
 * @author Yaroslav Palamarchuk
 */
class FormManager {
    /**
     * last field id for input id
     * @var int
     */
    public $elemId = 0;
       
    /**
     * new form method
     * @param array $options
     */
    public function start($options = []){
        /**
         * get real route
         */
        $route = \mill\core\Router::getRoute();
        /**
         * make this real route file path
         */
        $realpage = $route['prefix'].'/'.$route['controller'].'/'.$route['action'];
        /**
         * string with params
         */
        $s = '';
        
        foreach($options as $key =>$opt){
            /**
             * if action == real put real route file path
             */
            if($opt == 'real'){
                $opt = strtolower($realpage);
            }
            $s .= $key . "='$opt'";
        }
        /**
         * start new form
         */
        echo "<form {$s}>";
    }
    
    /**
     * makes new field
     * returns html input tag code
     * @param object $model
     * @param string $field
     * @param array $options
     * @return string
     */
    public function field($model, $field, $options = []){
        /**
         * if there is no field in the model
         */
        if(!isset($model->attributes[$field])) throw new \Exception('field ' . $field . ' not found', 404);
        /**
         * last field id plus
         */
        $this->elemId++;
        /**
         * returns html code
         */
        return $this->htmlForm($model, $field, $options);
        
    }
    /**
     * make new submit button with params
     * @param array $options like class, id, onclick...
     * @return string
     */
    public function submit($options = []){
        $str = '';
        foreach ($options as $k => $v){
            $str .= $k . "='$v'";
        }
        
        return "<input type='submit' {$str}>";
    }
    
    /**
     * makes new html form code
     * @param object $model
     * @param string $field
     * @param array $options
     * @return string
     */
    public function htmlForm($model, $field, $options){
        /**
         * id for input
         */
        $id = $field . '_' . $this->elemId;
        /**
         * if input type inserted use it
         */
        $type = isset($options['type']) ? $options['type'] : 'text';
        unset($options['type']);
        /**
         * label for input if exists
         */
        $str = isset($options['label']) ? "<label for='$id'>".$options['label'].'</label>' : '<label>'.$field.'</label>';
        unset($options['label']);
        /**
         * name for input
         * default like a field name
         */
        $name = isset($options['name']) ? $options['name'] : $field;
        unset($options['name']);
        /**
         * default class name if doesn't exists user's
         */
        $class = isset($options['class']) ? $options['class'] : 'form-control';
        unset($options['class']);
        /**
         * if label exsits
         */
        $islabel = isset($options['label']) ? $options['label'] : $field;
        unset($options['label']);
        /**
         * placeholer for input
         */
        $placeholder = isset($options['placeholder']) ? $options['placeholder'] : $islabel;
        unset($options['placeholder']);
        $tags = '';
        /**
         * other options like multiple
         */
        foreach($options as $k => $v){
            /**
             * if multiple insert [] to name
             */
            if($k === 'multiple'){
                $name .= '[]';
            }
            /**
             * add other tags
             */
            $tags .= "$k='$v'";
        }
        /**
         * make new input tag with params
        */
        $str .= "<input type='{$type}' class='{$class}' id='{$id}' name='{$name}' placeholder='{$placeholder}' {$tags}>";        
                
        return $str;    
    }
    /**
     * end form tag
     */
    public function end(){
        echo '</form>';
    }
    
    
}
