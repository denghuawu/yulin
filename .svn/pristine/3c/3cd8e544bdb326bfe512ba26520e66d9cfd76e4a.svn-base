<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'report_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'report_type')->textInput() ?>

    <?= $form->field($model, 'submit_leader')->textInput() ?>

    <?= $form->field($model, 'report_time_start')->textInput() ?>

    <?= $form->field($model, 'report_time_end')->textInput() ?>

    <?= $form->field($model, 'report_summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'next_plan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'em_id')->textInput() ?>

    <?= $form->field($model, 'admin_id')->textInput() ?>

    <?= $form->field($model, 'report_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
