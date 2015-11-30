<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Area */

$this->title = '编辑大区: ' . ' ' . $model->area_id;
$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->area_id, 'url' => ['view', 'id' => $model->area_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('../layouts/common'); ?>

<div class="area-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'manage' => $manage,
    ]) ?>

</div>
