<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PrePaid */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->employee->name, 'url' => ['employee/view', 'id'=>$model->employeeId]];
$this->params['breadcrumbs'][] = 'PrePaid';
\yii\web\YiiAsset::register($this);
?>
<div class="pre-paid-view">

    <h1><?= Html::encode($model->employee->name) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        
        <a class="btn btn-primary printBtn" href="javascript: void(0)" onclick="printTable('toPrint')">Print</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'employeeId',
                'value' => $model->employee->name
            ],
            [
                'attribute' => 'amount',
                'value' => $model->amount. ' LBP'
            ],
            'date',
            'comment:ntext',
        ],
    ]) ?>

</div>

<div id="toPrint" style="display: none">
    <h1>Choclate Bar</h1>
    <p>
        In <b><?=$model->date?></b>, <?=$model->employee->name?> received <b><?=$model->amount?> LBP</b> as pre-paid salary.
        <br>
        Comment: <?=$model->comment?>
        <br />
        <br />
        
        Signature:
    </p>
</div>
