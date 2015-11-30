<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Action */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList($data) ?>

    <?= $form->field($model, 'action_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action_sort')->textInput() ?>
    
    <?= $form->field($model, 'is_show')->radioList([0=>'否',1=>'是']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
