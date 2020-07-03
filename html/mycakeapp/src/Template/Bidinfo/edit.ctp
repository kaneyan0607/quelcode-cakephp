<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidinfo $bidinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bidinfo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bidinfo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Bidinfo'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bidmessages'), ['controller' => 'Bidmessages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bidmessage'), ['controller' => 'Bidmessages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bidinfo form large-9 medium-8 columns content">
    <?= $this->Form->create($bidinfo) ?>
    <fieldset>
        <legend><?= __('Edit Bidinfo') ?></legend>
        <?php
            echo $this->Form->control('biditem_id', ['options' => $biditems]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
