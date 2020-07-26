<h2><?= $evaluations[0]->user->username ?> の取引評価実績</h2>
<fieldset>
    <legend>評価の平均値：</legend>
    <?php
    $counter = 0; //評価された数
    $average = 0; //評価の合計
    foreach ($evaluations as $evaluation) {
        $average += $evaluation->evaluation;

        $counter++;
    }
    $average_evaluation = $average / $counter;
    //少数第二位以下を切り捨てて表示
    echo floor($average_evaluation * 10) / 10;
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