<?php

namespace mill\core;

use R;
/**
 * Description of DataBase Class
 * methods for work with database and connection
 * @author Yaroslav Palamarchuk
 */
class Db {

    /**
     * pdo prototype
     * @var db
     */
    protected static $pdo;

    /**
     * instance
     * @var instance
     */
    protected static $instance;

    /**
     * count SQL queries for debug panel
     * @var integer
     */
    public static $countSql = 0;

    /**
     * queries for debug panel
     * @var array
     */
    public static $queries = [];
    /**
     * database type like sqlite or mysql
     * @var string 
     */
    public static $dbtype;

    protected function __construct() {
        $db = require ROOT . '/config/db.php';
        require LIBS . '/rb.php';
        self::$dbtype = $db['type'];
        if($db['type'] == 'sqlite'){
            \R::setup('sqlite:'.ROOT.'/tmp/millenium.txt',$db['user'],$db['pass']);
        }else{
            \R::setup("mysql:host={$db['host']};dbname={$db['dbname']};", $db['user'], $db['pass']);
        }

        \R::freeze(true);
    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}
