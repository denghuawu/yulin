<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */

$this->title = '编辑商品: ' . ' ' . $model->goods_id;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->goods_id, 'url' => ['view', 'id' => $model->goods_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

 <?= $this->render('../layouts/common'); ?>

<div class="goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'cat_list' => $cat_list,
    	'brand_arr'=>$brand_arr,
    ]) ?>

</div>
