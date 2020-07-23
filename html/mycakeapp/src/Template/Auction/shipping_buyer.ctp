<h2><?= $authuser['username'] ?> 受取住所連絡画面</h2>
<h3>商品「<?= $bidinfo->biditem->name ?>」</h3>
<?= $this->Form->create('Bidinfo', ['type' => 'file']) ?>
<fieldset>
        <legend>連絡先（名前、住所、電話番号）NULL判定:</legend>
        <?php
        $name = $bidinfo->name;
        $address = $bidinfo->address;
        $phone_number = $bidinfo->phone_number;

        if ((is_null($name)) && (is_null($address)) && (is_null($phone_number))) {
                echo 'NULLです。';
        } else {
                echo 'NULLではありません。';
        }

        ?>
</fieldset>

<fieldset>
        <legend>受取連絡判定:</legend>
        <?php
        $is_received = $bidinfo->is_received;

        if (empty($is_received)) {
                echo '落札者が商品を受取りしていません。';
        } else {
                echo '落札者が商品を受取。';
        }

        ?>
</fieldset>

<fieldset>
        <legend>発送連絡判定:</legend>
        <?php
        $is_shipped = $bidinfo->is_shipped;

        if (empty($is_shipped)) {
                echo '未発送です。';
        } else {
                echo '出品者が商品を発送。';
        }

        ?>
</fieldset>

<!--   ↑ここまでif文メモ   -->

<!-- 連絡先の値が入っていなければ -->
<?php if ((is_null($name)) && (is_null($address)) && (is_null($phone_number))) { ?>

        <fieldset>
                <legend>発送先情報を入力：</legend>
                <?php
                echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
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
                <p>受取完了</p>
                <p>出品者を評価してください。</p>
        </fieldset>

<?php } ?>
