<?php
namespace mill\core\migrations;

/**
 * extended class for all migration classes 
 * @author Yaroslav Palamarchuk
 */
abstract class MigrationEditor {
    
    public $t = false;
    
    /**
     * create variable object with parameters
     * @param string $type
     * @param array $options
     * @return string
     */
    public function set($type, $options){
        $model = new Variables();
        return $model->make($type, $options);
    }
    
    /**
     * add data to column[ AFTER method createTable ! ]
     * @param string $table
     * @param array $options
     */
    public function addColumn($table, $options = []){
        /**
         * show data queries in the console
         */
        \R::fancyDebug();
        foreach ($options as $op){
            $keys = '(';
            $names = '(';
            $i = 0;
            foreach ($op as $k => $v){
                $i++;
                if($i == count($op)){
                    $keys .= $k.')';
                }else{
                    $keys .= $k.',';
                }  
                
                if($i == count($op)){
                    $names .= "'{$v}')";
                }else{
                    $names .= "'{$v}', ";
                }   
                
            }
            \R::exec("INSERT INTO $table {$keys} VALUES {$names}");
        }
    }
    
    /**
     * function creates new tables and columns of table
     * @param string $table table name
     * @param array $rows rows for table wit params
     */
    public function createTable($table, $rows){
        \R::fancyDebug();
        /**
         * todo
         */
        
        if(\mill\core\Db::$dbtype == 'sqlite'){
            $this->sqlite_create($table, $rows);
        }else{
            
        }$this->mysql_create($table, $rows);

    }
    
    
    public function sqlite_create($table, $rows){
        try {
            $query = "CREATE TABLE {$table}(";

            $i = count($rows);
            $a = 0;
            foreach ($rows as $k => $row) {
                $a++;
                $query .= $k . ' ' . $row;
                if ($a != $i) {
                    $query .= ',';
                }
            }
            $query .= ');';
            
            \R::exec($query);        
            
        } catch (\RedBeanPHP\RedException\SQL $e) {
            
            foreach ($rows as $k => $row) {
                
                \R::exec("ALTER TABLE {$table} ADD {$k} {$row}");
                
            }
        }
    }
    
    public function mysql_create($table, $row){
        if (\R::exec("SELECT name FROM sqlite_master WHERE type='table' AND name='{$table}'")) {
            foreach ($rows as $k => $row) {
                if (\R::exec("SHOW COLUMNS FROM `{$table}` LIKE '{$k}'")) {
                    \R::exec("ALTER TABLE `{$table}` MODIFY {$k} {$row}");
                } else {
                    \R::exec("ALTER TABLE {$table} ADD {$k} {$row}");
                }
            }
        } else {
            /**
             * else create a table with columns
             */
            $query = "CREATE TABLE {$table}(";

            $i = count($rows);
            $a = 0;
            foreach ($rows as $k => $row) {
                $a++;
                $query .= $k . ' ' . $row;
                if ($a != $i) {
                    $query .= ',';
                }
            }
            $query .= ');';

            \R::exec($query);
        }
    }
    
    /**
     * delete columns from table
     * @param string $table
     * @param array $name
     */
    public function dropColumn($table, $name = []){
        foreach($name as $c){
            \R::exec("ALTER TABLE {$table} DROP COLUMN $c");
        }
        
    }
    
}
