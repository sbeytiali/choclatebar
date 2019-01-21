<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use common\models\Employee;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\PrePaid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pre-paid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employeeId')->dropDownList(ArrayHelper::map(Employee::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?=
    $form->field($model, 'date')->widget(DatePicker::className(), [
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayBtn' => false
        ]
    ])
    ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
