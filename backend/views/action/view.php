
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Action */

$this->title = $model->action_id;
$this->params['breadcrumbs'][] = ['label' => 'Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common') ?>

<div class="action-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('行为列表', ['index', 'id' => $model->action_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Create Action', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->action_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->action_id], [
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
            'action_id',
            'parent_id',
            'action_name',
            'action_code',
            'action_url:url',
            'action_sort',
        	'is_show',
        ],
    ]) ?>

</div>
