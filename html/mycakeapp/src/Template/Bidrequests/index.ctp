<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bidrequest[]|\Cake\Collection\CollectionInterface $bidrequests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Bidrequest'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Biditems'), ['controller' => 'Biditems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Biditem'), ['controller' => 'Biditems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bidrequests index large-9 medium-8 columns content">
    <h3><?= __('Bidrequests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('biditem_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bidrequests as $bidrequest): ?>
            <tr>
                <td><?= $this->Number->format($bidrequest->id) ?></td>
                <td><?= $bidrequest->has('biditem') ? $this->Html->link($bidrequest->biditem->name, ['controller' => 'Biditems', 'action' => 'view', $bidrequest->biditem->id]) : '' ?></td>
                <td><?= $bidrequest->has('user') ? $this->Html->link($bidrequest->user->id, ['controller' => 'Users', 'action' => 'view', $bidrequest->user->id]) : '' ?></td>
                <td><?= $this->Number->format($bidrequest->price) ?></td>
                <td><?= h($bidrequest->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bidrequest->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bidrequest->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bidrequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bidrequest->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
