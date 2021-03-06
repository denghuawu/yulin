<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '密码重置';

?>

<?= $this->render('../layouts/common');?>

<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

	    <div class="admin-form">
	
	    <?php $form = ActiveForm::begin(); ?>
	    
	    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'comfirm_password')->passwordInput(['maxlength' => true]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
	    </div>
	
	    <?php ActiveForm::end(); ?>

		</div>

</div>
