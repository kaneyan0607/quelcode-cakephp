<?php

/**
 * @var \App\View\AppView $this 
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="content">
    <p><?= $post->created->i18nFormat(('YYYY年MM月dd日 HH:mm')) ?></p>
    <h1><?= h($post->title) ?></h1>
    <?= $this->Text->autoParagraph((h($post->body))) ?>
    <p><small>投稿者:<?= h($post->user->username) ?></small></p>
    <hr>
    <?= $this->Html->link('一覧へ戻る', [
        'action' => 'index'
    ], ['class' => 'button']) ?>
</div>
