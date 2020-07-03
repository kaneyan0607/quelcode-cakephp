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
                'limit' => 255,
            ])
            ->addColumn('body', 'text')
            ->addColumn('published', 'boolean', [
                'default' => false
            ])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
