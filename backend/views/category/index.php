<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('../layouts/common'); ?>

<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cat_id',
        	[
        		'attribute'=>'category_img',
        		'format' => 'html',
        		'value' => function($m){
        			if($m->category_img)
        				return Html::img(COMMON_PATH.'upload/category/'.$m->category_img,
        						['width' => '50px','height'=>'50px']);
        			else
        				return Html::img(COMMON_PATH.'upload/figure/default.png',
        						['width' => '50px','height'=>'50px']);
        		}
        	],
            'cat_name',
            [
            		'attribute'=>'parent_id',
            		'value' => function($m){return Category::get_cat_name($m->parent_id);}
        	],
            'sort_order',
             [
	             'attribute'=>'is_hot',
	             'format' => 'html',
	             'value' => function($m){
	             	return Html::img(COMMON_PATH.'upload/others/'.$m->is_hot.'.png',
	             			['width' => '20px','height'=>'20px']);
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
            // 'category_img',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>


<?php if(yii::$app->session->getFlash('failed')):?>
    <div style='color:red'>
    <script>
		alert("<?= yii::$app->session->getFlash('failed'); ?>");
    </script>
        <?php  yii::$app->session->setFlash('failed',null); ?>
    </div>
<?php endif; ?>
