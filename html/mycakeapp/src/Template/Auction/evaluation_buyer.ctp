<h2><?= h($authuser['username']) ?> 出品者への評価画面</h2>
<h3>商品名「<?= h($bidinfo->biditem->name) ?>」</h3>
<h4>出品者のアカウント名:「<?= h($bidinfo->biditem->user->username) ?>」</h4>
<?= $this->Form->create($evaluation, ['type' => 'post']) ?>
<fieldset>
    <legend>※出品者を評価する：</legend>
    <?php
    echo $this->Form->hidden('receive_evaluation_user_id', ['value' => $bidinfo->biditem->user->id]);
    echo $this->Form->hidden('evaluation_user_id', ['value' => $authuser['id']]);
    echo $this->Form->hidden('bidinfo_id', ['value' => $bidinfo->id]);
    echo $this->Form->control('comment', ['type' => 'textarea']);
    echo $this->Form->input('evaluation', array(
        'options' => array_combine(
            range(1, 5),
            range(1, 5)
        ),
        'empty' => '5段階で評価して下さい。'
    ));
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
