<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Overtime */

$this->title = 'Create Overtime';
$this->params['breadcrumbs'][] = ['label' => $model->employee->name, 'url' => ['employee/view', 'id'=>$model->employeeId]];
$this->params['breadcrumbs'][] = ['label' => 'Overtime'];
$this->params['breadcrumbs'][] = 'Add';
?>
<div class="overtime-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
