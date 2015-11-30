<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Role;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common'); ?>

<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            'user_name',
            'email',
            'mobile_phone',
        	[
        		'attribute'=>'role_id',
        		'value'=>function($m){return Role::find()->where(['role_id'=>$m->role_id])->asArray()->one()['role_name'];}	
    		],
    		'last_login',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
