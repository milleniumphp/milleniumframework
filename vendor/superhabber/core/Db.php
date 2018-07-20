<?php
namespace mill\core;

/**
 * DataBase Class
 * methods for work with database and connection
 * @author Yaroslav Palamarchuk
 */
class Db {

    /**
     * instance
     * @var instance
     */
    protected static $instance;

    /**
     * queries for debug panel
     * @var array
     */
    public static $queries = [];

    protected function __construct() {
        require LIBS . '/rb.php';
        /**
         * database config
         * used phinx migration system
         */
        $config = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(ROOT.'/phinx.yml'));
        /**
         * if DEBUG use development databse from db settings file /phinx.yml
         */
        if(DEBUG){
            $type = 'development';
        }else{
            $type = 'production';
        }
        /**
         * get data attributes from development or production db
         */
        $real[0] = $config['environments'][$type];
        /**
         * sqlite needs special setup
         */
        if($real[0]['adapter'] == 'sqlite'){
            $path = ROOT . $real[0]['name'] . $real[0]['suffix'];
            \R::setup("sqlite:{$path}");
        }else{
            /**
             * setup for all other db types
             * like mysql, pq ...
             */
            \R::setup("{$real[0]['adapter']}:host={$real[0]['host']};dbname={$real[0]['name']};", $real[0]['user'], $real[0]['pass']);
        }
        \R::startLogging();
        
        \R::freeze(true);

    }

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        
        return self::$instance;
    }
    
    public function __destruct() {
        /**
         * close db connection
         */
        \R::close();
    }

}
