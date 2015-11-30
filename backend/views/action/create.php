<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Action */

$this->title = '创建行为';
$this->params['breadcrumbs'][] = ['label' => 'Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common') ?>

<div class="action-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
    ]) ?>

</div>
