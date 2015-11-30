<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Admin;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common'); ?>

<div class="area-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加大区', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'area_id',
            'area_name',
        	[
        		'attribute' => 'admin_id',
        		'value' => function($m){
						return    Admin::findOne($m->admin_id)->user_name;	
    			}
    		],
            'area_sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
