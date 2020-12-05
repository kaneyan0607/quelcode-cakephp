<?php

use Migrations\AbstractSeed;

/**
 * Posts2 seed.
 */
class Posts2Seed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => '最初の投稿',
                'description' => '最初の投稿の概要',
                'body' => '最初の投稿の内容',
                'published' => 1,
                'created' => '2020-12-05 18:00:00',
                'modified' => '2020-12-05 18:00:00'
            ], [
                'title' => '2番目の投稿',
                'description' => '2番目の投稿の概要',
                'body' => '2番目の投稿の内容',
                'published' => 1,
                'created' => '2020-12-05 18:00:00',
                'modified' => '2020-12-05 18:00:00'
            ],
        ];

        $table = $this->table('posts2');
        $table->insert($data)->save();
    }
}
