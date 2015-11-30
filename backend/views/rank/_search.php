<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RankSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rank_name') ?>

    <?= $form->field($model, 'rank_desc') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
