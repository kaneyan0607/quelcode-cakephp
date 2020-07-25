<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation[]|\Cake\Collection\CollectionInterface $evaluation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evaluation'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluation index large-9 medium-8 columns content">
    <h3><?= __('Evaluation') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receive_evaluation_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evaluation_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bidinfo_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evaluation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evaluation as $evaluation): ?>
            <tr>
                <td><?= $this->Number->format($evaluation->id) ?></td>
                <td><?= $this->Number->format($evaluation->receive_evaluation_user_id) ?></td>
                <td><?= $this->Number->format($evaluation->evaluation_user_id) ?></td>
                <td><?= $this->Number->format($evaluation->bidinfo_id) ?></td>
                <td><?= h($evaluation->comment) ?></td>
                <td><?= h($evaluation->evaluation) ?></td>
                <td><?= h($evaluation->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evaluation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evaluation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evaluation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]) ?>
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
