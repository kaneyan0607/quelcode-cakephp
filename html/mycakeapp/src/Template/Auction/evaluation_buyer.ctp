<h2><?= $authuser['username'] ?> 出品者への評価画面</h2>
<h3>商品「<?= $bidinfo->biditem->name ?>」</h3>
<h4>出品者「<?= $bidinfo->biditem->user->username ?>」様</h4>
<?= $this->Form->create('evaluation', ['type' => 'post']) ?>
<fieldset>
    <legend>※出品者を評価する：</legend>
    <?php
    echo $this->Form->hidden('receive_evaluation_user_id', ['value' => $bidinfo->biditem->user->id]);
    echo $this->Form->hidden('evaluation_user_id', ['value' => $authuser['id']]);
    echo $this->Form->hidden('bidinfo_id', ['value' => $bidinfo->id]);
    echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
    echo $this->Form->control('comment', ['type' => 'textarea']);
    echo $this->Form->input('evaluation', array(
        'options' => array_combine(
            range(1, 5),
            range(1, 5)
        ),
        'empty' => '5段階で評価して下さい。'
    ));
    //var_dump($bidinfo);
    //echo '>>>>>>>>>>>>>>>>>>>>>>';
    //評価テーブルに落札情報idがあるか確認する。
    //echo h($bidinfo['evaluation'][0]->bidinfo_id);
    //$evaluation_db = $bidinfo['evaluation'][0]->bidinfo_id;
    //echo $evaluation_db;
    //if (empty($bidinfo['evaluation'][0]->bidinfo_id)) {
    //    echo '評価の値が入ってない';
    //    //echo $bidinfo['evaluation'][0]->bidinfo_id;
    //} else {
    //    echo '評価の値が入ってます。evaluationのbidinfo_id:';
    //    echo $bidinfo['evaluation'][0]->bidinfo_id;
    //}
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
