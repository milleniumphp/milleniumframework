<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mill\core\console\database;

/**
 * Description of Backup
 *
 * @author Yaroslav Palamarchuk
 */
class Backup {
    /**
     * user arguments
     * @var array
     */
    public $argv;
    /**
     * create argument list
     * @param array $argv
     */
    public function __construct($argv) {
        $this->argv = $argv;
        /**
         * default backup function
         */
        $this->backuptable(); 
    }
    /**
     * function for backup
     */
    public function backuptable(){
        /**
         * if you wanna make new backup file, not restore
         */
        if ($this->argv[4] !== '--get') {
            /**
             * all files in directory 
             */
            $files = scandir(ROOT . '/tmp/backup/database');
            /**
             * table name for backuping
             */
            $table = $this->argv[3];
            /**
             * all files ids
             */
            $ids = $this->getFiles($files, $table);
            /**
             * get last id for creating a new file
             */
            $lastid = isset($ids) ? max($ids)['id'] : 0;
            /**
             * library for random integers and strings
             */
            $factory = new \RandomLib\Factory;
            $randomInt = $factory->getMediumStrengthGenerator()->generateInt(1);
            /**
             * data for backuping
             */
            $data = \R::find("{$table}");
            
            $mas = '';
            /**
             * compress data to one line
             */
            foreach ($data as $v) {
                $mas .= $v;
            }
            /**
             * make new backup file
             */
            file_put_contents(ROOT . '/tmp/backup/database/' . $table . '_'. ($lastid+1) .'_' . $randomInt, $mas);
        }else{
            /**
             * if you wanna restore your data
             */
            $this->restore();
        }    
    }
    /**
     * data restore
     */
    public function restore(){
        /**
         * all files in backup directory
         */
        $files = scandir(ROOT . '/tmp/backup/database');
        $table = $this->argv[3];
        /**
         * if exists backup file id in console input
         */
        if($this->argv[5]){
            foreach ($files as $k => $file) {
                preg_match('/(?P<name>\w+)_(?P<id>\d+)_(?P<key>\d+)/', $file, $m);
                if ($m["name"] === $table && $m['id'] === $this->argv[5]) {
                    $ids[] = $m;
                }
            }
            $ids = max($ids);
        }else{
            /**
             * else get last file id
             */
            $ids = max($this->getFiles($files, $table));
        }
        /**
         * file content
         */
        $l = file_get_contents(ROOT . '/tmp/backup/database/' . $table.'_' . $ids['id'].'_' . $ids['key']);
        /**
         * loop function to explode data to array
         */
        $a = explode('}', $l);
        
        for ($e = 0; $e < max(array_keys($a)); $e++) {
            $convert_to_array = explode(',', trim($a[$e], '{}'));
            for ($i = 0; $i < count($convert_to_array); $i++) {
                $key_value = explode(':', str_replace('"', '', $convert_to_array [$i]));
                $data[$e][$key_value[0]] = $key_value [1];
            }
        }
        /**
         * show queries in console
         */
        \R::fancyDebug(true);
       
        foreach($data as $k => $u){
            $str = '';
            $n = '';
            $i = 0;
            foreach ($u as $key => $val){
                $i++;
                if($i != count($u)){
                    $n .= $key.',';
                }else{
                    $n .= $key;
                }
                
            }
            $i = 0;
            foreach ($u as $key => $val){  
                $i++;
                if($i != count($u)){
                    $str .= "'$val',";
                }else{
                    $str .= "'$val'";
                }
            }
            unset($i);
            /**
             * add data to table
             */
            \R::exec("INSERT INTO {$table} ({$n}) VALUES ({$str})");
        }     
    }
    /**
     * makes loop, and returns all backup id's
     * @param array $files
     * @param string $table
     * @return array
     */
    public function getFiles($files, $table) {
        foreach ($files as $k => $file) {
            unset($m);
            preg_match('/(?P<name>\w+)_(?P<id>\d+)_(?P<key>\d+)/', $file, $m);
            if ($m["name"] === $table) {
                $ids[] = $m;
            }
        }
        return $ids;
    }

}
