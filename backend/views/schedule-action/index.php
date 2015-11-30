<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScheduleActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedule Actions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-action-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Schedule Action', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sch_theme',
            'sch_type',
            'customer_id',
            'execute_id',
            // 'execute_partner',
            // 'priority_level',
            // 'shc_desc:ntext',
            // 'sch_time_start:datetime',
            // 'sch_time_end:datetime',
            // 'complete_level',
            // 'em_id',
            // 'admin_id',
            // 'createed_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
