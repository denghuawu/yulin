<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'report_title') ?>

    <?= $form->field($model, 'report_type') ?>

    <?= $form->field($model, 'submit_leader') ?>

    <?= $form->field($model, 'report_time_start') ?>

    <?php // echo $form->field($model, 'report_time_end') ?>

    <?php // echo $form->field($model, 'report_summary') ?>

    <?php // echo $form->field($model, 'next_plan') ?>

    <?php // echo $form->field($model, 'em_id') ?>

    <?php // echo $form->field($model, 'admin_id') ?>

    <?php // echo $form->field($model, 'report_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
