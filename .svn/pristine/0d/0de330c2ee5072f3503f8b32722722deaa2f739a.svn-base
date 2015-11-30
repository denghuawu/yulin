<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BrandSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'brand_id') ?>

    <?= $form->field($model, 'brand_name') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
