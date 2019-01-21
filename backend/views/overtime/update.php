<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Overtime */

$this->title = 'Update Overtime: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->employee->name, 'url' => ['employee/view', 'id'=>$model->employeeId]];
$this->params['breadcrumbs'][] = ['label' => 'Overtimes'];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="overtime-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
