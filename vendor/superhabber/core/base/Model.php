<?php
namespace mill\core\base;

use mill\core\Db;
/**
 * @author Yaroslav Palamarchuk
 */
class Model {

    /**
     * columns for form
     * @var array
     */
    public $attributes = [];

    /**
     * registration errors
     * @var array
     */
    public static $errors = [];

    /**
     * default instance
     */
    public function __construct() {
        $this->pdo = Db::instance(); 
    }

    public function load($data) {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data) {
        $v = new \Valitron\Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        self::$errors = $v->errors();
        return false;
    }

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
     * save user to the table
     * @param string $table
     * @return bool
     */
    public function save($table) {
        $tbl = \R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function login($data = []) {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if(\mill\core\App::$app->user->login($login, $password, $data)) return true;
    }

}
