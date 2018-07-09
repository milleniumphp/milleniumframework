<?php
/**
 * default migration by Phinx Migration
 * migration for user table for authentication system
 * enter 'vendor/bin/phinx migrate -e development' into your console
 */

use Phinx\Migration\AbstractMigration;

class CreateUsers extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('user');
        $table->addColumn('name', 'string', ['limit' => 255])  
              ->addColumn('login', 'string', ['limit' => 255])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('email', 'string', ['limit' => 255])
              ->addColumn('role', 'enum', ['values' => ['user', 'admin']])
              ->addColumn('updated_at', 'datetime')
              ->addColumn('created_at', 'datetime',['null' => true])
        ->create();
    }
}
