<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ActionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'action_name') ?>

    <?= $form->field($model, 'action_code') ?>

    <?= $form->field($model, 'action_url') ?>

    <?php // echo $form->field($model, 'action_sort') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
