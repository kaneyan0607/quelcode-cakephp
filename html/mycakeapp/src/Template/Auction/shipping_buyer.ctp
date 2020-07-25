<h2><?= $authuser['username'] ?> 受取住所連絡画面</h2>
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
                <legend>発送先情報を入力：</legend>
                <?php
                echo '<p>出品者のアカウント名 : ' . $bidinfo->biditem->user->username . '<p>';
                echo $this->Form->control('name');
                echo $this->Form->control('address');
                echo $this->Form->control('phone_number');
                ?>
        </fieldset>

        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

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
                echo '<p>出品者が商品を発送しました</p>';
                echo $this->Form->label('is_received', '受取済');
                echo $this->Form->checkbox('is_received');
                ?>
        </fieldset>

        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

<?php } else { ?>

        <fieldset>
                <legend>取引状況：</legend>
                <?php if (empty($bidinfo['evaluation'][0]->bidinfo_id)) { ?>
                        <p>取引が終了しました。出品者を評価して下さい。</p>
                        <?= $this->Html->link(__($bidinfo->biditem->user->username . 'さんを評価する。'), ['action' => 'evaluation_buyer', $bidinfo->id]) ?>
                <?php } elseif ($bidinfo['evaluation'][0]->evaluation_user_id === $authuser['id']) { ?>
                        <p>商品受取済。（取引終了）</p>
                        <p>評価済みです。</p>
                <?php } else { ?>
                        <p>取引が終了しました。出品者を評価して下さい。</p>
                        <?= $this->Html->link(__($bidinfo->biditem->user->username . 'さんを評価する。'), ['action' => 'evaluation_buyer', $bidinfo->id]) ?>
                <?php } ?>
        </fieldset>

<?php } ?>
