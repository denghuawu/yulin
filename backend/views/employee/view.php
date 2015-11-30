<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

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
            'em_sn',
            'em_name',
            'mobile_phone',
            'id_card',
            'birthday',
            'marriage',
            'sex',
            'ss_number',
            'native_place',
            'domicile',
            'card_no',
            'nation',
            'admin_id',
            'used_name',
            'political_status',
            'height',
            'weight',
            'self_introduction:ntext',
            'qq',
            'email:email',
            'emergency_contact',
            'emergency_phone',
            'now_address',
            'home_phone',
            'position_status',
            'em_type',
            'entry_time:datetime',
            'leave_time:datetime',
            'has_probation',
            'probation_time_start:datetime',
            'probation_time_end:datetime',
            'regular_time:datetime',
            'engage_time_start:datetime',
            'engage_time_end:datetime',
            'depart_id',
            'job_id',
            'salary',
            'tp_type',
            'join_work_time:datetime',
            'graduate_school',
            'graduate_time:datetime',
            'major',
            'education_level',
            'pro_certificate',
            'education_exp:ntext',
            'work_exp:ntext',
        ],
    ]) ?>

</div>
