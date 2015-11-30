<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Region;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = '商城设置';
?>

<?= $this->render('../layouts/common'); ?>

<div class="user-update">
	<h1><?= Html::encode($this->title) ?></h1>
	
<form action="index.php?r=shop/index" method='post'>
    
	<div class="user-form">
	
	    <?php 
	    	
	    	foreach($shop as $k=>$v){
	    		switch ($v['type'])
	    		{
	    			case 'text':
	    				
	    				echo '<label class="control-label" >'.$v['name'].'</label><input type="text" class="form-control" name="'.$v['code'].'" value="'.$v['value'].'">';
	    				break;
	    			case 'radio':
	    				$flag = $v['value']==1 ? "checked" :'';
	    				$flag2 = $v['value']==0 ? "checked" :'';
	    				echo '<label class="control-label" >'.$v['name'].'</label><input type="radio" name="'.$v['code'].'" '.$flag.' value="1">是　
							<input type="radio"  name="'.$v['code'].'" '.$flag2.' value="0">否';
	    				break;
	    			case 'textarea':
	    				echo '<label class="control-label" >'.$v['name'].'</label><textarea class="form-control" name="'.$v['code'].'">'.$v['value'].'</textarea>';
	    				break;
	    		}
	    		echo '<div class="help-block"></div>';
	    	}
	    ?>
	
	    <div class="form-group">
	        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
	    </div>
	
	
	
	</div>

</div>
