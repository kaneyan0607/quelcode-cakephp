<?php

use Migrations\AbstractSeed;

/**
 * Posts seed.
 */
class PostsSeed extends AbstractSeed
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
                'title' => "最初の投稿",
                'description' => "<script>alert('JavaScriptの実行');</script>\n最初の投稿の概要\n改行文章",
                'body' => '最初の投稿の内容',
                'published' => 1,
                'user_id' => 1,
                'created' => '2020-07-03 10:00:00',
                'modified' => '2020-07-03 10:00:00'
            ], [
                'title' => "2番目の投稿",
                'description' => '2番目の投稿の概要',
                'body' => '2番目の投稿の内容',
                'published' => 0,
                'user_id' => 1,
                'created' => '2020-07-01 12:00:00',
                'modified' => '2020-07-01 12:00:00'
            ], [
                'title' => "非表示の投稿タイトル",
                'description' => '非表示の投稿の概要',
                'body' => '非表示の投稿の内容',
                'published' => 0,
                'user_id' => 2,
                'created' => '2020-05-02 10:00:00',
                'modified' => '2020-05-02 10:00:00'
            ], [
                'title' => "テストタイトル",
                'description' => 'テストタイトル投稿の概要',
                'body' => 'テストタイトル投稿の内容',
                'published' => 1,
                'user_id' => 2,
                'created' => '2020-05-03 00:00:00',
                'modified' => '2020-05-03 00:00:00'
            ], [
                'title' => "5番目の投稿",
                'description' => '5番目の投稿の概要',
                'body' => '5番目の投稿の内容',
                'published' => 1,
                'user_id' => 1,
                'created' => '2020-05-05 00:00:00',
                'modified' => '2020-05-05 00:00:00'
            ],
        ];

        $table = $this->table('posts');
        $table->insert($data)->save();
    }
}
