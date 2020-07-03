<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidrequest $bidrequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Bidrequests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bidrequests form large-9 medium-8 columns content">
    <?= $this->Form->create($bidrequest) ?>
    <fieldset>
        <legend><?= __('Add Bidrequest') ?></legend>
        <?php
            echo $this->Form->control('biditem_id', ['options' => $biditems]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('price');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
