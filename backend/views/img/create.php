<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Img */

$this->title = '添加广告图';
$this->params['breadcrumbs'][] = ['label' => 'Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

 <?= $this->render('../layouts/common'); ?>

<div class="img-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
