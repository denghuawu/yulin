<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '上传广告图';
$this->params['breadcrumbs'][] = $this->title;
?>

 <?= $this->render('../layouts/common'); ?>

<div class="img-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加广告图', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
        	[
        		'attribute'=>'name',
        		'format' => 'html',
        		'value' => function($m){
        			if($m->name)
        				return Html::img(COMMON_PATH.'upload/img/'.$m->name,
        						['width' => '50px','height'=>'50px']);
        		}
        	],
            [
	            'attribute'=>'url',
	            'format' => 'url',
	            'value' => function($m){
	            	return substr($m->url,0,30);
	            }
            ],
			[
				'attribute'=>'type',
				'value'=> function($m){return $m->type == 1 ? '顶部广告图' : '中部广告图';}	
        	],
			[
				'attribute'=>'act_type',
				'value'=> function($m){
        				if($m->type!='1'){

        					return $m->act_type == '1' ? '新品' : ($m->act_type == '2' ? '热门' : '推荐') ;
        				}
        				return '';
        			}	
        	],

        	[
        	'attribute'=>'is_show',
        	'format' => 'html',
        	'value' => function($m){
        		return Html::img(COMMON_PATH.'upload/others/'.$m->is_show.'.png',
        				['width' => '20px','height'=>'20px']);
        	}
        	],
            'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
