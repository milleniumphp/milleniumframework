<?php
namespace mill\core\base;

use mill\core\Db;
/**
 * @author Yaroslav Palamarchuk
 */
class Model {

    /**
     * pdo prototype
     * @var db
     */
    protected $pdo;

    /**
     * table name
     * @var string
     */
    protected $table;

    /**
     * key for model[standart = id]
     * @var string
     */
    protected $pk = 'id';

    /**
     * columns for form
     * @var array
     */
    public $attributes = [];

    /**
     * rules for validation
     * @var array
     */
    public $rules = [];

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

    public function getErrors($session) {
        $errors = '<ul>';
        foreach (self::$errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= '</ul>';
        $session->data['error'] = $errors;
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

    /**
     * method query returns false if is in query error
     * @param  string $sql sql query
     * @return bool      
     */
//    public function query($sql) {
//        return $this->pdo->execute($sql);
//    }

    /**
     * find all data from table in self::$table
     * @return array returned data
     */
//    public function findAll() {
//        $sql = "SELECT * FROM {$this->table}";
//        return $this->pdo->query($sql);
//    }

    /**
     * find one data from table in self::$table with self::pk
     * @return array returned data
     */
//    public function findOne($id, $field = '') {
//        $field = $field ?: $this->pk;
//        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
//        return $this->pdo->query($sql, [$id]);
//    }

    /**
     * find by sql query
     * @param  string $sql    sql query string
     * @param  array  $params params for finding 
     * @return array         data which returned
     */
//    public function findBySql($sql, $params = []) {
//        return $this->pdo->query($sql, $params);
//    }

    /**
     * find with like cond
     * @param  string $str   which str you wanna find
     * @param  string $field table field
     * @param  string $table table name
     * @return db        
     */
//    public function findLike($str, $field, $table = '') {
//        $table = $table ?: $this->table;
//        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
//        return $this->pdo->query($sql, ['%' . $str . '%']);
//    }

    public function login($data = []) {
        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if(\mill\core\App::$app->user->login($login, $password, $data)) return true;

    }

}
