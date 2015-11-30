<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = '编辑分类: ' . ' ' . $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_id, 'url' => ['view', 'id' => $model->cat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('../layouts/common'); ?>

<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'cat_list' => $cat_list,
    ]) ?>

</div>
