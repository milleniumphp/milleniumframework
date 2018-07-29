<?php
namespace mill\core\base;

/**
 * @author Yaroslav Palamarchuk
 */
class Model {

    /**
     * registration errors
     * @var array
     */
    public static $errors = [];

    /**
     * default instance
     */
    public function __construct() {
        \mill\core\Db::instance(); 
    }

    /**
     * valitron validation method
     * @param array $data post or get params to validate
     * @return boolean
     */
    public function validate($data) {
        $v = new \Valitron\Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) return true;
        
        self::$errors = $v->errors();
        return false;
    }
    
    /**
     * get errors from valitron validator
     * @param object $session session variable
     */
    public function getErrors($session = null) {
        $errors = '<ul>';
        foreach (self::$errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= '</ul>';
        if(isset($session)) $session->data['error'] = $errors;
    }

    /**
     * default user login method which can be changed in your child model
     * @param array $data
     * @param string $login login attribute
     * @param string $password password attribute
     * @return boolean
     */
    public function login($data = [], $login = 'login', $password = 'password') {
        $login = !empty(trim($_POST[$login])) ? trim($_POST[$login]) : null;
        $password = !empty(trim($_POST[$password])) ? trim($_POST[$password]) : null;
        if(\Mill::$user->login($login, $password, $data)) return true;
    }

}
