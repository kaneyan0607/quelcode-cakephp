<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidinfo $bidinfo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bidinfo'), ['action' => 'edit', $bidinfo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bidinfo'), ['action' => 'delete', $bidinfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidinfo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bidinfo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidinfo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bidmessages'), ['controller' => 'Bidmessages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidmessage'), ['controller' => 'Bidmessages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bidinfo view large-9 medium-8 columns content">
    <h3><?= h($bidinfo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Biditem') ?></th>
            <td><?= $bidinfo->has('biditem') ? $this->Html->link($bidinfo->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $bidinfo->biditem->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $bidinfo->has('user') ? $this->Html->link($bidinfo->user->id, ['controller' => 'Users', 'action' => 'view', $bidinfo->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bidinfo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($bidinfo->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bidinfo->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bidmessages') ?></h4>
        <?php if (!empty($bidinfo->bidmessages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bidinfo Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($bidinfo->bidmessages as $bidmessages): ?>
            <tr>
                <td><?= h($bidmessages->id) ?></td>
                <td><?= h($bidmessages->bidinfo_id) ?></td>
                <td><?= h($bidmessages->user_id) ?></td>
                <td><?= h($bidmessages->message) ?></td>
                <td><?= h($bidmessages->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bidmessages', 'action' => 'view', $bidmessages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bidmessages', 'action' => 'edit', $bidmessages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bidmessages', 'action' => 'delete', $bidmessages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidmessages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
