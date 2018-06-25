<?php namespace app\migrations;

class examples_shopproducts_1_1241795668 extends \mill\core\migrations\MigrationEditor{
   
    public $table = 'examples_shopproducts';

    public function up(){
        
        $this->createTable($this->table, [
            'id'=> $this->set("integer",["notNull"=>true, "length"=>9, "primary"=>true, "increment"=>true]),
            'title'=> $this->set('string', ['notNull'=>true, 'length'=>255]),
            'image'=> $this->set('string', ['notNull'=>true, 'length'=>255, 'default'=>null]),
            'category_id'=> $this->set('integer', ['notNull'=>true, 'default'=>null]),
            'price'=> $this->set('integer', ['notNull'=>true, 'default'=>0])
        ]);
        
        $this->addColumn($this->table, [
            ['id'=>1, 'title'=>'Lebron soldier 11', 'image'=>'https://goo.gl/1athzP', 'category_id'=>5, 'price'=>120],
            ['id'=>2, 'title'=>'Lebron soldier 12', 'image'=>'https://goo.gl/YnE8wL', 'category_id'=>5, 'price'=>125],
            ['id'=>3, 'title'=>'Stefan Janoski', 'image'=>'https://goo.gl/48Uu9W', 'category_id'=>5, 'price'=>85],
            ['id'=>4, 'title'=>'Air max 97 ultra', 'image'=>'https://goo.gl/1zo2yT', 'category_id'=>5, 'price'=>97],
            ['id'=>5, 'title'=>'nike t shirt', 'image'=>'https://goo.gl/nD7qyx', 'category_id'=>10, 'price'=>45],
            ['id'=>6, 'title'=>'nike women t shirt', 'image'=>'https://goo.gl/gcfi3G', 'category_id'=>11, 'price'=>45],
            ['id'=>7, 'title'=>'vans t shirt', 'image'=>'https://goo.gl/aKDvoD', 'category_id'=>10, 'price'=>45],
            ['id'=>8, 'title'=>'vans t shirt', 'image'=>'https://goo.gl/m26PVX', 'category_id'=>10, 'price'=>45]
        ]);
    }
    
    public function down(){
        $this->dropColumn($this->table, ["id"]);
    }


}
               
