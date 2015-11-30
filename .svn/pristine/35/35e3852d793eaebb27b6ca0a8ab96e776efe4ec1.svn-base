<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.zhe div{float:left;margin:0 10px;}
</style>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <div class='zhe clearfix'>
	    <?= $form->field($model,'cat_id')->dropDownList($cat_list,
	    [
	        'prompt'=>'--请选择--',
	        'onchange'=>'
	            $.post("'.yii::$app->urlManager->createUrl('goods/linkcat').'&cat_id="+$(this).val(),function(data){
	                $("select#goodssearch-brand_id").html(data);
	            });',
	    'style'=>'width:150px;text-align:left']) ?>
	    
	    <?= $form->field($model, 'brand_id')->dropDownList($brand_arr,['style'=>'width:150px;']) ?>
		
	    <?= $form->field($model, 'goods_id')->textInput(['style'=>'width:150px;']) ?>
		
	    <?= $form->field($model, 'goods_name')->textInput(['style'=>'width:200px;']) ?>
	
		
	    <div class="form-group"><br >
	        <?= Html::submitButton('搜索商品', ['class' => 'btn btn-primary']) ?>
	    </div>
	</div>
	
    <?php ActiveForm::end(); ?>

</div>
