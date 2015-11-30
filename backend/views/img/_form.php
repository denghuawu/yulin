<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Img */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="img-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

     <?= $form->field($model, 'name')->fileInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'type')->radioList([1=>'顶部广告图',2=>'中部广告图']) ?>
    
    <?= $form->field($model, 'act_type')->radioList([1=>'新品',2=>'热门',3=>'推荐']) ?>
    
    <?= $form->field($model, 'is_show')->radioList([1=>'显示',0=>'不显示']) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
