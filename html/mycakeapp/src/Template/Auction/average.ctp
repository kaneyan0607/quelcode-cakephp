<h2><?= h($evaluations[0]->user->username) ?> の取引評価実績</h2>
<fieldset>
    <legend>評価の平均値：</legend>
    <?php
    $counter = 0; //評価された数
    $average = 0; //評価の合計
    foreach ($evaluations as $evaluation) {
        $average += $evaluation->evaluation;
        $counter++;
    }
    //割り算
    $average_evaluation = $average / $counter;
    //少数第二位以下を切り捨て
    $average_answer =  floor($average_evaluation * 10) / 10;
    echo number_format($average_answer, 1);
    ?>
</fieldset>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th scope="col" class="actions"><?= __('Comment') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($evaluations as $evaluation) : ?>
            <tr>
                <td><?= h($evaluation->comment) ?></td>
                <td><?= h($evaluation->created) ?></td>
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
</div>

<!-- 商品ページに戻る-->
<?= $this->Html->link(__('<<商品詳細情報に戻る'), ['action' => 'view', $bidinfo_id]) ?>
