<?php

namespace mill\core\base;

/**
 * Description of User
 * base class of User
 * @author Yaroslav Palamarchuk
 */
class User {
    
    public $properties = [];
    
    public function __construct() {
        if (isset($_SESSION['user'])) {
            foreach ($_SESSION['user'] as $k => $v) {
                $this->properties[$k] = $v;
            }
        }
    }

    public function isGuest(){
        if(empty($this->properties)){
            return true;
        }
        return false;
    }
    
    public function login($login, $password, $data = [], $options = []){
        if($login && $password){
            if(!empty($data)){
                foreach ($data as $k => $v){
                    if($v['login'] == $login && $v['password'] == $password){
                        foreach ($v as $d) {
                            if ($d != 'password') {
                                $_SESSION['user'][$k] = $v;
                                $this->properties[$k] = $v;
                            }
                        }
                        return true;
                    }
                }
                Model::$errors['type'][] = isset($options['wrong']) ?  $options['wrong'] : 'Incorrect data entered';
                return false;
            }
            $user = \R::findOne('user', 'login = ? LIMIT 1', [$login]);
            if($user){
                if(password_verify($password, $user->password)){
                    foreach ($user as $k => $v){
                        if($k != 'password'){
                            $_SESSION['user'][$k] = $v;
                            $this->properties[$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
        Model::$errors['type'][] = isset($options['wrong']) ?  $options['wrong'] : 'Incorrect data entered';
    }
    
    public function logout($redirect){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect($redirect);
    }
    
    public function property($name = ''){
        if($name){
            return $this->properties[$name];
        }else{
            return $this->properties;
        }
    }
    
}
