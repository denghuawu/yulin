<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rank */

$this->title = '编辑等级: ' . ' ' . $model->rank_id;
$this->params['breadcrumbs'][] = ['label' => 'Ranks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rank_id, 'url' => ['view', 'id' => $model->rank_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('../layouts/common'); ?>

<div class="rank-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
