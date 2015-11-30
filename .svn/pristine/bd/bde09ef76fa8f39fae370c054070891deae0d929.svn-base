<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

table label.label1{width:300px;}
table label.label2{width:200px;}
</style>
<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'role_desc')->textarea(['rows' => 3]) ?>

    <div class="form-group field-role-action_list required">
    
    <?php 
    	echo "行为分配<table class='xinwei'>";
    	$action_list = !is_array($model['attributes']['action_list']) ? explode(',',$model['attributes']['action_list']) : $model['attributes']['action_list'];
    	
    	foreach($data as $key=>$val){
			if(isset($val['child'])){
				echo "<tr>";
				echo '<td><label class="label1"><input type="checkbox" name="Role[action_list][]" value="'.$val['action_url'].'"> '.$val['action_name'].'</label></td>';
				echo '<td>';
				foreach ($val['child'] as $k=>$v){
					
					$is_checked = in_array($v['action_url'], $action_list) ? 'checked' : '';
					
					echo '<label class="label2"><input type="checkbox" name="Role[action_list][]" '.$is_checked.' value="'.$v['action_url'].'"> '.$v['action_name'].'</label>';
				}
				echo '</td>';
				echo "<br/>";
				
				echo "</tr>";
			}

    	}
    	echo "</table>";
    ?>

	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
var label1= document.getElementsByClassName('label1');
var label2= document.getElementsByClassName('label2');
var check= label2[0].getElementsByTagName('input')[0];
$('table.xinwei input[type="checkbox"]').click(function(e){

	if ($(e.target).parent().hasClass("label1")) {
		if ($(e.target).is(":checked")) {
			$(e.target).parents('tr').find('.label2 input[type="checkbox"]').attr("checked",true);
			console.log($(e.target).parents('tr').find('.label2 input[type="checkbox"]'))
			
		}else{
			console.log($(e.target).parents('tr').find('.label2 input[type="checkbox"]'))
			$(e.target).parents('tr').find('.label2 input[type="checkbox"]').attr("checked",false);
		}
	}
	else{
		var k=0;
		for (var i =0; i < $(e.target).parents('tr .label2').find('input[type="checkbox"]').length; i++) {
			if ($(e.target).parents('tr .label2').find('input[type="checkbox"]').eq(i).is(":checked")) {
				k++;
				return;
			}
		}
		if (k==0) {
			$(e.target).parents('tr').find('input[type="checkbox"]').attr("checked","checked");
		}
	}

});
    
</script>
