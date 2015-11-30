<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>
    

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'comfirm_password')->passwordInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->dropDownList($data) ?>
    
    <?= $form->field($model, 'flag')->hiddenInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
