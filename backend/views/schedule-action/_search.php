<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ScheduleActionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-action-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sch_theme') ?>

    <?= $form->field($model, 'sch_type') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'execute_id') ?>

    <?php // echo $form->field($model, 'execute_partner') ?>

    <?php // echo $form->field($model, 'priority_level') ?>

    <?php // echo $form->field($model, 'shc_desc') ?>

    <?php // echo $form->field($model, 'sch_time_start') ?>

    <?php // echo $form->field($model, 'sch_time_end') ?>

    <?php // echo $form->field($model, 'complete_level') ?>

    <?php // echo $form->field($model, 'em_id') ?>

    <?php // echo $form->field($model, 'admin_id') ?>

    <?php // echo $form->field($model, 'createed_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
