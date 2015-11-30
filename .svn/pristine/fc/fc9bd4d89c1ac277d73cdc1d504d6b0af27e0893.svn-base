<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
    
    <? echo  $form->field($model, 'real_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->radioList([1=>'男',0=>'女']) ?>
    
    <?= $form->field($model, 'province')->dropDownList(Region::region_list(),
    		[
	    		'prompt'=>'--请选择--',
	    		'onchange'=>'
	            $.post("'.yii::$app->urlManager->createUrl('user/region').'&parent_id="+$(this).val(),function(data){
	                $("select#user-city").html(data);
	            });',
    		]
    ) ?>
    
    <?= $form->field($model, 'city')->dropDownList($city_option) ?>

    <?= $form->field($model, 'user_rank')->dropDownList($rank_list) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($manager_list) ?>
    
    <?= $form->field($model, 'admin_id')->dropDownList($admin_user) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'work_time')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'figure')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
