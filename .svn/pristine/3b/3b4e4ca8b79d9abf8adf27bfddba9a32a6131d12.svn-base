<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>

 <?= $this->render('../layouts/common'); ?>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_id',
            'order_sn',
        	'user_id',
        	[
        			'attribute' =>'user',
        			'value' => function($m){return User::get_user_name($m->user_id);}
        	],
        	'order_amount',
        		
        	[
        		'attribute' =>'order_status',
        		'value' => function($m){return order_status(['order_status'=>$m->order_status])['name'];}
        	],
            // 'pay_status',
            // 'address',
            // 'shipping_name',
            // 'pay_id',
            // 'pay_name',
            // 'goods_amount',
            // 'shipping_fee',
            // 'pay_fee',
            // 'order_amount',
            // 'add_time',
            // 'confirm_time',
            // 'pay_time',
            // 'shipping_time',
            // 'extension_code',
            // 'message',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
