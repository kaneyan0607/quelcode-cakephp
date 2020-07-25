<h2><?= $authuser['username'] ?> の発送連絡画面</h2>
<h3>商品「<?= $bidinfo->biditem->name ?>」</h3>
<?= $this->Form->create('Bidinfo', ['type' => 'file']) ?>

<?php
$name = $bidinfo->name;
$address = $bidinfo->address;
$phone_number = $bidinfo->phone_number;
$is_received = $bidinfo->is_received;
$is_shipped = $bidinfo->is_shipped;
?>

<!-- 連絡先の値が入っていなければ -->
<?php if ((is_null($name)) && (is_null($address)) && (is_null($phone_number))) { ?>

    <fieldset>
        <legend>取引状況：</legend>
        <?php echo '<p>落札者のアカウント名 : ' . $bidinfo->user->username . '<p>'; ?>
        <p>落札者からの連絡をお待ち下さい。</p>
    </fieldset>

    <!-- 連絡先の値が入っていて商品が未発送か判定　-->
<?php } elseif ((!is_null($name)) && (!is_null($address)) && (!is_null($phone_number)) && (empty($is_shipped))) { ?>

    <fieldset>
        <legend>落札者情報：</legend>
        <?php
        echo '<p>落札者名 : ' . $bidinfo->name . '<p>';
        echo '<p>発送先住所 : ' . $bidinfo->address . '<p>';
        echo '<p>連絡先電話番号 : ' . $bidinfo->phone_number . '<p>';
        ?>
    </fieldset>

    <fieldset>
        <legend>発送連絡：</legend>
        <?php
        echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
        echo $this->Form->label('is_shipped', '発送済');
        echo $this->Form->checkbox('is_shipped');
        //var_dump($bidinfo);
        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <!-- 連絡先の値が入っていて商品が発送済か判定　-->
<?php } elseif ((!is_null($name)) && (!is_null($address)) && (!is_null($phone_number)) && (!empty($is_shipped)) && (empty($is_received))) { ?>

    <fieldset>
        <legend>取引状況：</legend>
        <p>商品を発送しました。落札者からの受取完了連絡をお待ち下さい。</p>
    </fieldset>

<?php } else { ?>

    <fieldset>
        <legend>取引状況：</legend>
        <?php if (empty($bidinfo['evaluation'][1]->bidinfo_id)) { ?>
            <p>取引が終了しました。落札者を評価して下さい。</p>
            <?= $this->Html->link(__($bidinfo->user->username . 'さんを評価する。'), ['action' => 'evaluation_exhibitor', $bidinfo->id]) ?>
        <?php } elseif ($bidinfo['evaluation'][1]->evaluation_user_id === $authuser['id']) { ?>
            <p>商品受取済。（取引終了）</p>
            <p>評価済みです。</p>
        <?php } else { ?>
            <p>取引が終了しました。落札者を評価して下さい。</p>
            <?= $this->Html->link(__($bidinfo->user->username . 'さんを評価する。'), ['action' => 'evaluation_exhibitor', $bidinfo->id]) ?>
        <?php } ?>
    </fieldset>

<?php } ?>
