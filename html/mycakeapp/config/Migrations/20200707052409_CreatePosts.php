<?php

use Migrations\AbstractMigration;

class CreatePosts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('posts');
        $table
            ->addColumn('title', 'string', [
                'limit' => 150,
                'null' => false
            ])
            ->addColumn('description', 'text', [
                'limit' => 255
            ])
            ->addColumn('body', 'text')
            ->addColumn('published', 'boolean', [
                'default' => false
            ])
            ->addColumn('user_id', 'integer', [
                'default' => 1,
                'limit' =>  11,
                'null' => false
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
