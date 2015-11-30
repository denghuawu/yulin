<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FieldOption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'option_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_value')->textInput() ?>
    
    <?= $form->field($model, 'parent_id')->dropDownList($parent_option) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
