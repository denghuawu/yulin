<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ScheduleAction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-action-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sch_theme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sch_type')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'execute_id')->textInput() ?>

    <?= $form->field($model, 'execute_partner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority_level')->textInput() ?>

    <?= $form->field($model, 'shc_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sch_time_start')->textInput() ?>

    <?= $form->field($model, 'sch_time_end')->textInput() ?>

    <?= $form->field($model, 'complete_level')->textInput() ?>

    <?= $form->field($model, 'em_id')->textInput() ?>

    <?= $form->field($model, 'admin_id')->textInput() ?>

    <?= $form->field($model, 'createed_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
