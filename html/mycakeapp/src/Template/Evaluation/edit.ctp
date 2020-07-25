<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Evaluation $evaluation
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $evaluation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Evaluation'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="evaluation form large-9 medium-8 columns content">
    <?= $this->Form->create($evaluation) ?>
    <fieldset>
        <legend><?= __('Edit Evaluation') ?></legend>
        <?php
            echo $this->Form->control('receive_evaluation_user_id');
            echo $this->Form->control('evaluation_user_id');
            echo $this->Form->control('bidinfo_id');
            echo $this->Form->control('comment');
            echo $this->Form->control('evaluation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
