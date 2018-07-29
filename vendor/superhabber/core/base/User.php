<?php
namespace mill\core\base;

/**
 * Description of User
 * base class of User
 * @author Yaroslav Palamarchuk
 */
class User {
    
    const AUTH_USER = [
        'auth' => true,
        'guest' => false
    ];
    
    const REAL_USER = [];
    
    const ALL_USER = [
        'auth' => true,
        'guest' => true
    ];
    
    public static $properties = [];
    
    public function __construct() {
        if(isset($_SESSION['user'])) self::$properties = $_SESSION['user'][0];
    }


    public function isGuest(){
        if(empty(self::$properties)) return true;
        return false;
    }
    
    public function login($login, $password, $data = [], $options = ['key' => 'login']){
        if($login && $password){
            if(!empty($data)){
                foreach ($data as $k => $v){
                    if(($v['login'] == $login) && ($v['password'] == $password)){
                        foreach ($v as $d) {
                            if ($d != 'password') {
                                $_SESSION['user'][$k] = $v;
                                self::$properties[$k] = $v;
                            }
                        }
                        return true;
                    }
                }
                Model::$errors['type'][] = isset($options['wrong']) ?  $options['wrong'] : 'Incorrect data entered';
                return false;
            }
            $user = \R::findOne('user', "{$options['key']} = ? LIMIT 1", [$login]);
            if($user){
                if(password_verify($password, $user->password)){
                    foreach ($user as $k => $v){
                        if($k != 'password'){
                            $_SESSION['user'][$k] = $v;
                            self::$properties[$k] = $v;
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
            return self::$properties[$name];
        }
        return self::$properties;
    }
    
    public static function middleware($rule){
        if($rule(__CLASS__)['type']['auth'] == true && !empty(self::$properties) ){
            $rule(__CLASS__)['preaction'](__CLASS__);
        }else if ($rule(__CLASS__)['type']['guest'] == true && $rule(__CLASS__)['type']['auth'] == true ){
            $rule(__CLASS__)['preaction'](__CLASS__);
        }else{
            $e = new \mill\core\base\ErrorController(404, null, null);
            http_response_code(404);
            $e->usererror(8,'Access Forbidden');
        }
    }
    
}
