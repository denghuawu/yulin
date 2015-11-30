<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model backend\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_id')->dropDownList($manage) ?>

    <?= $form->field($model, 'area_sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
