<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Img */

$this->title = '编辑广告图: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

 <?= $this->render('../layouts/common'); ?>

<div class="img-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
