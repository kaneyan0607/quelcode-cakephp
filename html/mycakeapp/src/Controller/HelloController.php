<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{

    public function index()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->set('title', 'Hello!');

        if ($this->request->isPost()) {
            $this->set('data', $this->request->data['Form1']);
        } else {
            $this->set('data', []);
        }
    }

    public function form()
    {
        $this->viewBuilder()->autoLayout(false);
        $name = $this->request->data['name'];
        $mail = $this->request->data['mail'];
        $age = $this->request->data['age'];
        $res = 'こんにちは、 ' . $name . '（' . $age .
            '）さん。メールアドレスは、' . $mail . ' ですね？';
        $values = [
            'title' => 'Result',
            'message' => $res
        ];
        $this->set($values);
    }
}
