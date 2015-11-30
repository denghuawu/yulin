<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorkReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Work Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Work Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'report_title',
            'report_type',
            'submit_leader',
            'report_time_start:datetime',
            // 'report_time_end:datetime',
            // 'report_summary:ntext',
            // 'next_plan:ntext',
            // 'em_id',
            // 'admin_id',
            // 'report_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
