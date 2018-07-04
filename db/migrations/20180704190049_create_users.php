<?php


use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('users_test');
        $table->addColumn('name', 'string', ['limit' => 255])  
              ->addColumn('updated_at', 'datetime')
              ->addColumn('created_at', 'datetime',['null' => true])
              ->create();
    }
}
