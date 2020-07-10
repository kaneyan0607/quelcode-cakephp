<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidrequest $bidrequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Bidrequest'), ['action' => 'edit', $bidrequest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Bidrequest'), ['action' => 'delete', $bidrequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidrequest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Bidrequests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bidrequest'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bidrequests view large-9 medium-8 columns content">
    <h3><?= h($bidrequest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Biditem') ?></th>
            <td><?= $bidrequest->has('biditem') ? $this->Html->link($bidrequest->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $bidrequest->biditem->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $bidrequest->has('user') ? $this->Html->link($bidrequest->user->id, ['controller' => 'Users', 'action' => 'view', $bidrequest->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bidrequest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($bidrequest->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($bidrequest->created) ?></td>
        </tr>
    </table>
</div>
