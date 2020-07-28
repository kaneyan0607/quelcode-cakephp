<h2><?= h($authuser['username']) ?> の発送連絡画面</h2>
<h3>商品名「<?= h($bidinfo->biditem->name) ?>」</h3>
<?= $this->Form->create($bidinfo, ['type' => 'post']) ?>

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
        <?php echo '<p>落札者のアカウント名 : ' . h($bidinfo->user->username) . '<p>'; ?>
        <p>落札者からの連絡をお待ち下さい。</p>
    </fieldset>

    <!-- 落札者の連絡先の値が入っていて商品が未発送か判定　-->
<?php } elseif ((!is_null($name)) && (!is_null($address)) && (!is_null($phone_number)) && (empty($is_shipped))) { ?>

    <fieldset>
        <legend>落札者情報：</legend>
        <?php
        echo '<p>落札者名 : ' . h($bidinfo->name) . '<p>';
        echo '<p>発送先住所 : ' . h($bidinfo->address) . '<p>';
        echo '<p>連絡先電話番号 : ' . h($bidinfo->phone_number) . '<p>';
        ?>
    </fieldset>

    <fieldset>
        <legend>発送連絡：</legend>
        <?php
        echo '<p>商品の発送連絡をする。</p>';
        echo $this->Form->label('is_shipped', '発送済');
        echo $this->Form->checkbox('is_shipped');
        echo $this->Form->error('is_shipped');
        ?>
    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <!-- 連絡先の値が入っていて商品が発送済か判定　-->
<?php } elseif ((!is_null($name)) && (!is_null($address)) && (!is_null($phone_number)) && (!empty($is_shipped)) && (empty($is_received))) { ?>

    <fieldset>
        <legend>取引状況：</legend>
        <p>商品は発送済みです。落札者からの受取完了連絡をお待ち下さい。</p>
    </fieldset>

<?php } else { ?>

    <!-- 自分で出品し、自分で落札した商品は、出品者、落札者から見てどちらか１度のみ評価できるものにする。-->
    <fieldset>
        <legend>取引状況：</legend>
        <?php if (empty($bidinfo['evaluation'])) {
            echo '<p>取引が終了しました。落札者を評価して下さい。</p>';
            echo  $this->Html->link(__(h($bidinfo->user->username) . 'さんを評価する。'), ['action' => 'evaluation_exhibitor', $bidinfo->id]);
        } elseif ($bidinfo['evaluation'][0]->evaluation_user_id === $authuser['id']) {
            echo '<p>評価済みです。</p>';
            echo $this->Html->link(__('ホームに戻る'), ['action' => 'home2']);
        } elseif (!empty($bidinfo['evaluation'][1])) {
            if ($bidinfo['evaluation'][1]->evaluation_user_id === $authuser['id']) {
                echo '<p>評価済みです。</p>';
                echo $this->Html->link(__('ホームに戻る'), ['action' => 'home2']);
            }
        } else {
            echo '<p>取引が終了しました。落札者を評価して下さい。</p>';
            echo  $this->Html->link(__(h($bidinfo->user->username) . 'さんを評価する。'), ['action' => 'evaluation_exhibitor', $bidinfo->id]);
        } ?>
    </fieldset>
<?php } ?>
<br>
<?php echo $this->Html->link(__('<<ホームに戻る'), ['action' => 'home2']); ?>
