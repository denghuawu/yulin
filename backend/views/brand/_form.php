<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'cat_id')->dropDownList($cat_list) ?>

    <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'brand_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'brand_logo')->fileInput() ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'is_show')->radioList(['1'=>'显示','0'=>'不显示']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
