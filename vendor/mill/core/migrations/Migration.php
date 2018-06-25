<?php
namespace mill\core\migrations;

/**
 * Description of Migration Class
 * base Migration Class makes queries to other classes
 * @author Yaroslav Palamarchuk
 */
class Migration {
    
    /**
     * basic options for migrations
     * @var array
     */
    public $options = [];
    
    /**
     * last migration file key
     * @var string
     */
    public $randomKey;
    
    /**
     * get console params and add it to options var
     * @param array $argv
     */
    public function __construct($argv) {
        foreach(array_slice($argv, 2) as $elem){
            $this->options[] = $elem;
        }
    }
    
    /**
     * create new migration file 
     */
    public function create_migration(){
        /**
         * lib for random string
         */
        $factory = new \RandomLib\Factory;
        $generator = $factory->getMediumStrengthGenerator();
        $this->randomKey = $generator->generateInt(1);
        /**
         * get all migraiton files
         */
        $files = scandir(ROOT . '/app/migrations');
        $ids = [];
        if ($this->options[1]) {
            foreach ($files as $file) {
                if (preg_match("/(?P<name>\w+)_(?P<id>\d+)_(?P<key>\d+)/", $file, $m)) {
                    if ($m['name'] == $this->options[1]) {
                        $ids[] = $m['id'];
                    }
                }
            }

            rsort($ids);
            $lastid = $ids[0] ?: 0;
            $this->createMigrationFile($lastid);
        }else{
            echo 'Please enter migration table name';
        }
    }
    
    /**
     * create class inside the file
     * @param int $id
     */
    public function createMigrationFile($id){
        file_put_contents(ROOT . '/app/migrations'.$this->options[1].'_' . ($id+1) . '_'.$this->randomKey.'.php', 
"<?php namespace app\migrations;

class {$this->options[1]}_" . ($id+1) . "_{$this->randomKey} extends \mill\core\migrations\MigrationEditor{
   
    public ". '$table' ." = '{$this->options[1]}';

    public function up(){
        return ". '$this->createTable($this->table, [
            \'id\'=>$this->set("integer",["notNull"=>true, "length"=>9, "primary"=>true, "increment"=>true])
  
        ]);' ."
    }
    
    public function down(){
        ". '$this->dropColumn($this->table, ["id"])'.";
    }


}
               
");
    }
    /**
     * make new migration
     * can be with params like: migrate users --down / --up
     */
    public function migrate() {
        $files = scandir(ROOT . '/app/migrations');
        /**
         * if already exists old migration file
         */
        if (!$this->options[2]) {
            
            $ef = [];
            foreach ($files as $file) {
                if (preg_match("/(?P<name>\w+)_(?P<id>\d+)_(?P<key>\d+)/", $file, $m)) {
                    if ($m['name'] == $this->options[1]) {
                        $ef[] = $m;
                    }
                }
            }
            rsort($ef);
            $cpath = '\app\migrations\\' . $ef[0][0];
            
        }else{
            
            foreach ($files as $file) {
                if (preg_match("/(?P<name>\w+)_(?P<id>\d+)_(?P<key>\d+)/", $file, $m)) {
                    if ($m['name'] == $this->options[1]) {
                        if($m['id'] == $this->options[2]){
                            $c = $m[0];
                        }
                    }
                }
            }
            
            $cpath = '\app\migrations\\' . $c;
            
        }
        
        $c = new $cpath();
        /** 
         * if param exists
         */
        if($this->options[3]){
            $method = substr($this->options[3], 2);
            $c->$method();
        }else{
            $c->up();
        }
        
    }

}
