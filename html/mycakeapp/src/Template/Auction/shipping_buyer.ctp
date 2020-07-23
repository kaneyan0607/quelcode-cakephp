<h2><?= $authuser['username'] ?> の発送先連絡画面</h2>
<h3>商品「<?= $bidinfo->biditem->name ?>」</h3>
<?= $this->Form->create('Bidinfo', ['type' => 'file']) ?>
<fieldset>
        <legend>※発送先情報を入力：</legend>
        <?php
        echo '<p><strong>USER: ' . $authuser['username'] . '</strong></p>';
        echo $this->Form->control('name');
        echo $this->Form->control('address');
        echo $this->Form->control('phone_number');

        ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
