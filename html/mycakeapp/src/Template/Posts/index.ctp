<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post[] $posts
 * 
 */
?>
<div class="content">
    <?php foreach ($posts as $post) : ?>
        <h3><?= $post->title ?></h3>
        <p><?= $post->created ?></p>
        <p><?= $post->description ?></p>
        <hr>
    <?php endforeach ?>
</div>
