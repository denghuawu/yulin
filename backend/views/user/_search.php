<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.zhe div{float:left;margin:0 10px;}
</style>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class='zhe clearfix'>
	    <?= $form->field($model, 'user_id') ?>
	
	    <?= $form->field($model, 'user_name') ?>
	
	    <?php  echo $form->field($model, 'mobile_phone') ?>
	
	
	    <div class="form-group"><br >
	        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
	    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
