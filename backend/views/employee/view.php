<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Overtime;
use kartik\export\ExportMenu;

//use common\models\PrePaid;
//use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?> | <?= date('Y M', strtotime($myDate)) ?></h1>

    <p></p>


    <?= Html::beginForm(['/employee/view', 'id' => $model->id], 'POST'); ?>
    <?= Html::dropDownList('Year', $year, Overtime::getYearList(), ['options'=>['class' => 'form-control']]) ?>
    <?= Html::dropDownList('Month', $month, Overtime::getMonthList()) ?>
    <?= Html::submitButton('Sumit', ['class' => 'btn btn-primary']); ?>
    <?= Html::endForm(); ?>
    <p></p>
    <p></p>
    <hr>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'title',
                'value' => $model->titleName,
            ],
            'startDate',
            'salary',
        ],
    ])
    ?>


    <h1>Overtime | Total: <?= $overtimeAmount . ' LBP' ?></h1>
    <?= Html::a('Add Overtime', ['overtime/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <p></p>

    <div class="panel">
        <?=
        ExportMenu::widget([
            'target' => ExportMenu::TARGET_BLANK,
            'dataProvider' => $overDataProvider,
            'columns' => [ [ 'class' => 'yii\grid\SerialColumn'],
                //'id',
                'date',
                [
                    'attribute' => 'overtime',
                    'value' => function($data) {
                        return $data->overtime . 'h';
                    },
                ],
                [
                    'attribute' => 'amount',
                    'value' => function ($data) {
                        return $data->amount . ' LBP';
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'controller' => '/overtime'
                ],
            ],
            'exportConfig' => [
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_HTML => false,
            ],
        ]);
        ?>
    </div>

    <?=
    GridView::widget([
        'dataProvider' => $overDataProvider,
        //'filterModel' => $overSearchModel,
        'columns' => [ [ 'class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'date',
            //'filter' => Overtime::getMonthList(),
            ],
            [
                'attribute' => 'overtime',
                'value' => function($data) {
                    return $data->overtime . 'h';
                },
            ],
            [
                'attribute' => 'amount',
                'value' => function ($data) {
                    return $data->amount . ' LBP';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'controller' => '/overtime'
            ],
        ],
    ]);
    ?>

    <p></p>
    <hr>
    <h1>PrePaid | Total: <?= $prepaidAmount . ' LBP' ?></h1>
    <?= Html::a('Add Prepaid', ['pre-paid/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <p></p>

    <div class="panel">
        <?=
        ExportMenu::widget([
            'target' => ExportMenu::TARGET_BLANK,
            'dataProvider' => $preDataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'attribute' => 'date',
                //'filter' => PrePaid::getMonthList(),
                ],
                [
                    'attribute' => 'amount',
                    'value' => function ($data) {
                        return $data->amount . ' LBP';
                    },
                ],
                'comment',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'controller' => '/pre-paid'
                ],
            ],
            'exportConfig' => [
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_HTML => false,
            ],
        ]);
        ?>
    </div>
    <?=
    GridView::widget([
        'dataProvider' => $preDataProvider,
        //'filterModel' => $preSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'date',
            //'filter' => PrePaid::getMonthList(),
            ],
            [
                'attribute' => 'amount',
                'value' => function ($data) {
                    return $data->amount . ' LBP';
                },
            ],
            'comment',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'controller' => '/pre-paid'
            ],
        ],
    ]);
    ?>

    <p></p>
    <hr>
    <h1>Net Salary: <?= $salary . ' LBP' ?></h1>
    <p></p>

</div>
