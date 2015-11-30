<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色列表';
$this->params['breadcrumbs'][] = $this->title;
?>

 <?= $this->render('../layouts/common'); ?>

<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加角色', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'role_id',
            'role_name',
            'role_desc',
        	['class' => 'yii\grid\ActionColumn','header'=>'操作','template' => ' {update}'],
        ],
    		
    		
    ]); ?>

</div>


<?php if(yii::$app->session->getFlash('failed')):?>
    <div style='color:red'>
        <?php echo yii::$app->session->getFlash('failed'); yii::$app->session->setFlash('failed',null); ?>
    </div>
<?php endif; ?>



