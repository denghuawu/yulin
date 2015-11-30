<?php

use yii\helpers\Html; 


/* @var $this yii\web\View */
/* @var $model common\models\UserAddress */

$this->title = '收货信息填写';
$this->params['breadcrumbs'][] = ['label' => '用户收货地址列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;	
?>


<div class="user-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
