<?php
namespace mill\core\base;

/**
 * Description of User
 * base class of User
 * @author Yaroslav Palamarchuk
 */
class User {
    
    public static $properties = [];
    
    public function __construct() {
        if(isset($_SESSION['user'])) self::$properties = $_SESSION['user'];
    }

    public function save($data, $table){
    	$user = \R::dispense($table);
		foreach ($data as $k => $d){
			if($k !== 'csrf_token'){
				$user->$k = $d;
			}
		}
	    if(\R::store($user)){
			return true;
	    }
    }


    public function isGuest(){
        if(empty(self::$properties)) return true;
        return false;
    }
    
    public function login($login, $password, $options){
        if($login && $password){
            $user = \R::findOne('user', "{$options['login']} = ? LIMIT 1", [$login]);
            if($user){
                if(password_verify($password, $user->password)){
                    foreach ($user as $k => $v){
                        if($k != $options['password']){
                            $_SESSION['user'] = $v;
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

	/**
	 * @param array $data
	 * @param string $login post login
	 * @param string $password post password
	 * @param array $options login and password names
	 *
	 * @return bool
	 */
    public function loginTest($data, $login, $password, $options){
	    if(!empty($data)){
		    foreach ($data as $k => $v){
			    if(($v[$options['login']] == $login) && ($v[$options['password']] == $password)){
				    foreach ($v as $d) {
					    if ($d != $options['password']) {
						    $_SESSION['user'] = $v;
						    self::$properties[$k] = $v;
					    }
				    }
				    return true;
			    }
		    }
		    Model::$errors['type'][] = isset($options['wrong']) ?  $options['wrong'] : 'Incorrect data entered';
		    return false;
	    }
    }

	/**
	 * @param string $redirect path to redirecting user
	 */
    public function logout($redirect){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect($redirect);
    }

	/**
	 * @param string $name get user's property
	 *
	 * if not isset name returns all properties
	 *
	 * @return array|mixed
	 */
    public function property($name = ''){ 
        return $name ? self::$properties[$name] : self::$properties;
    }
    
}
