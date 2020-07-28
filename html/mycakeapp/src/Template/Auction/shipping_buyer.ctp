<h2><?= $authuser['username'] ?> の受取住所連絡画面</h2>
<h3>商品名「<?= h($bidinfo->biditem->name) ?>」</h3>
<?= $this->Form->create($bidinfo, ['type' => 'post']) ?>
<?php
$name = $bidinfo->name;
$address = $bidinfo->address;
$phone_number = $bidinfo->phone_number;
$is_received = $bidinfo->is_received;
$is_shipped = $bidinfo->is_shipped;
?>

<!-- 落札者の連絡先の値が入っていなければ -->
<?php if ((is_null($name)) or (is_null($address)) or (is_null($phone_number))) { ?>

        <fieldset>
                <legend>発送先情報を入力：</legend>
                <?php
                echo '<p>出品者のアカウント名 : ' . h($bidinfo->biditem->user->username) . '<p>';
                echo $this->Form->control('name');
                echo $this->Form->control('address');
                echo $this->Form->control('phone_number');
                ?>
        </fieldset>

        <?= $this->Form->button(__('Submit')) ?>

        <!-- 連絡先の値が入っていて商品が未発送か判定　-->
<?php } elseif ((!is_null($name)) && (!is_null($address)) && (!is_null($phone_number)) && (empty($is_shipped))) { ?>

        <fieldset>
                <legend>取引状況：</legend>
                <p>出品者が商品を発送準備中です。</p>
        </fieldset>

        <!-- 連絡先の値が入っていて商品が発送済か判定　-->
<?php } elseif ((!is_null($name)) && (!is_null($address)) && (!is_null($phone_number)) && (!empty($is_shipped)) && (empty($is_received))) { ?>

        <fieldset>
                <legend>受取連絡：</legend>
                <?php
                echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
                echo '<p>出品者が商品を発送しました。</p>';
                echo $this->Form->label('is_received', '受取完了');
                echo $this->Form->checkbox('is_received');
                echo $this->Form->error('is_received');
                ?>
        </fieldset>

        <?= $this->Form->button(__('Submit')) ?>

<?php } else { ?>

        <!-- 自分で出品し、自分で落札した商品は、出品者、落札者から見てどちらか１度のみ評価できるものにする。-->
        <fieldset>
                <legend>取引状況：</legend>
                <?php if (empty($bidinfo['evaluation'])) {
                        echo '<p>取引が終了しました。出品者を評価して下さい。</p>';
                        echo  $this->Html->link(__(h($bidinfo->biditem->user->username) . 'さんを評価する。'), ['action' => 'evaluation_buyer', $bidinfo->id]);
                } elseif ($bidinfo['evaluation'][0]->evaluation_user_id === $authuser['id']) {
                        echo '<p>評価済みです。</p>';
                } elseif (!empty($bidinfo['evaluation'][1])) {
                        if ($bidinfo['evaluation'][1]->evaluation_user_id === $authuser['id']) {
                                echo '<p>評価済みです。</p>';
                        }
                } else {
                        echo '<p>取引が終了しました。出品者を評価して下さい。</p>';
                        echo  $this->Html->link(__(h($bidinfo->biditem->user->username) . 'さんを評価する。'), ['action' => 'evaluation_buyer', $bidinfo->id]);
                } ?>
        </fieldset>

<?php } ?>
<?= $this->Form->end() ?>
<br>
<?php echo $this->Html->link(__('<<ホームに戻る'), ['action' => 'home']); ?>
