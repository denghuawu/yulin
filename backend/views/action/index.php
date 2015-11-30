<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actions';
$this->params['breadcrumbs'][] = $this->title;


?>

<?= $this->render('../layouts/common') ?>

<div class="action-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Action', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
    
            'action_id',
            'parent_id',
            'action_name',
            'action_code',
            'action_url:url',
            // 'action_sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
