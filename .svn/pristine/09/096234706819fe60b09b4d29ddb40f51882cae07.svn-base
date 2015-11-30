<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WorkReport */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Work Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-report-view">

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
            'report_title',
            'report_type',
            'submit_leader',
            'report_time_start:datetime',
            'report_time_end:datetime',
            'report_summary:ntext',
            'next_plan:ntext',
            'em_id',
            'admin_id',
            'report_time:datetime',
        ],
    ]) ?>

</div>
