<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.zhe div{float:left;margin:0 10px;}
</style>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	
	<div class='zhe clearfix'>
	
		<?= $form->field($model, 'order_status')->dropDownList([
				''=>'请选择',
				UNPAYED=>'未付款',
				PAYED=>'已付款',
				SHIPPED=>'已发货',
				FINISHED=>'已收货',
				COMMENTED=>'已评价',
				RETURNED=>'退款',
				CANCEL=>'已取消订单',
				FAILED=>'交易失败']
		) ?>
		
	    <?= $form->field($model, 'order_id') ?>
	
	    <?= $form->field($model, 'order_sn') ?>
	
	    <?= $form->field($model, 'user_id') ?>
	
	    <div class="form-group"><br >
	        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
	    </div>
	    
	    <div class="form-group"><br >
	    	<a href="<?= Url::to(['order/export-excel']) ?>" >
	      	  <?= Html::Button('导出Excel 出库单', ['class' => 'btn btn-primary']) ?>
	        </a>
	    </div>

    
    </div>

    <?php ActiveForm::end(); ?>

</div>
