<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_desc')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($cat_list) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'is_hot')->radioList([1=>'否',0=>'是']) ?>

    <?= $form->field($model, 'is_show')->radioList([1=>'显示',0=>'不显示']) ?>

    <?= $form->field($model, 'category_img')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
