<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rank */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $this->render('../layouts/common'); ?>

<div class="rank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rank_desc')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
