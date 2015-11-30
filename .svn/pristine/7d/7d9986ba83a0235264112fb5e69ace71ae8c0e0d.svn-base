<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员等级';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common'); ?>

<div class="rank-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加等级', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'rank_id',
            'rank_name',
            'rank_desc',

            ['class' => 'yii\grid\ActionColumn','template' => '{update}']
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