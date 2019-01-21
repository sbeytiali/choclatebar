<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PrePaid */

$this->title = 'Update Pre Paid: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $model->employee->name, 'url' => ['employee/view', 'id'=>$model->employeeId]];
$this->params['breadcrumbs'][] = ['label' => 'Pre Paids'];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pre-paid-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
