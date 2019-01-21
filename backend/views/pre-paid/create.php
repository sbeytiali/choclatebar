<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PrePaid */

$this->title = 'Create Pre Paid';
$this->params['breadcrumbs'][] = ['label' => $model->employee->name, 'url' => ['employee/view', 'id'=>$model->employeeId]];
$this->params['breadcrumbs'][] = ['label' => 'Pre Paids'];
$this->params['breadcrumbs'][] = 'Add';
?>
<div class="pre-paid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
