<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ScheduleAction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Schedule Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-action-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sch_theme',
            'sch_type',
            'customer_id',
            'execute_id',
            'execute_partner',
            'priority_level',
            'shc_desc:ntext',
            'sch_time_start:datetime',
            'sch_time_end:datetime',
            'complete_level',
            'em_id',
            'admin_id',
            'createed_time:datetime',
        ],
    ]) ?>

</div>
