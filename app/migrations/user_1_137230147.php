<?php namespace app\migrations;

class user_1_137230147 extends \mill\core\migrations\MigrationEditor{
   
    public $table = 'user';

    public function up(){
        return $this->createTable($this->table, [
            'id'=>$this->set("integer",["notNull"=>true, "length"=>9, "primary"=>true, "increment"=>true]),
            'login'=>$this->set('string', ['notNull'=>true, 'length'=>255, 'unique'=>true]),
            'password'=>$this->set('string', ['notNull'=>true, 'length'=>255]),
            'email'=>$this->set('string', ['notNull'=>true, 'length'=>255, 'unique'=>true]),
            'name'=>$this->set('string', ['notNull'=>true, 'length'=>255]),
            'role'=>$this->set('enum', ['notNull'=>true, 'length'=>'"user","admin"', 'default'=>'"user"'])
  
        ]);
    }
    
    public function down(){
        $this->dropColumn($this->table, ["id"]);
    }


}
               
