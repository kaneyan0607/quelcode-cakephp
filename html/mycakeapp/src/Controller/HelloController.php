<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public $autoRender = false;

    public function index()
    {
        $id = 'no name';
        if (isset($this->request->query['id'])) {
            $id = $this->request->query['id'];
        }
        $pass = 'no password';
        if (isset($this->request->query['pass'])) {
            $pass = $this->request->query['pass'];
        }
        echo '<html><body><h1>Hello!</h1>';
        echo '<ul><li>your id: ' . $id . '</li>';
        echo '<li>password: ' . $pass . '</li></ul>';
        echo '</body></html>';
    }
}
