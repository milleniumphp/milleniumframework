<?php namespace app\migrations;
/**
 * hello.
 * 
 */
class examples_shopcategories_1_64459388 extends \mill\core\migrations\MigrationEditor{
   
    public $table = 'examples_shopcategories';

    public function up(){
        /**
         * create table with columns
         */
        $this->createTable($this->table, [
            'id'=>$this->set("integer",["notNull"=>true, "length"=>9, "primary"=>true, "increment"=>true]),
            'title'=> $this->set('string', ['notNull'=>true, "length"=>255]),
            'parent'=> $this->set('integer', ['notNull'=>true, "length"=>9, 'default'=>'0'])
        ]);
        /**
         * add default shop data to database
         */
        $this->addColumn($this->table,[
            ['id'=>1, 'title'=>'Sportswear', 'parent'=>0],
            ['id'=>2, 'title'=>'mens', 'parent'=>0],
            ['id'=>3, 'title'=>'womens', 'parent'=>0],
            ['id'=>4, 'title'=>'kids', 'parent'=>0],
            ['id'=>5, 'title'=>'nike', 'parent'=>1],
            ['id'=>6, 'title'=>'under armour', 'parent'=>1],
            ['id'=>7, 'title'=>'adidas', 'parent'=>1],
            ['id'=>8, 'title'=>'puma', 'parent'=>1],
            ['id'=>9, 'title'=>'asics', 'parent'=>1],
            ['id'=>10, 'title'=>'t shirts', 'parent'=>2],
            ['id'=>11, 'title'=>'t shirts', 'parent'=>3],
            ['id'=>12, 'title'=>'t shirts', 'parent'=>4],
        ]);
        
    }
    
    public function down(){
        $this->dropColumn($this->table, ["id"]);
    }


}
               
