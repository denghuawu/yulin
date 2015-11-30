<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */

$this->title = '编辑品牌: ' . ' ' . $model->brand_id;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->brand_id, 'url' => ['view', 'id' => $model->brand_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('../layouts/common'); ?>

<div class="brand-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'brand_list'=>$brand_list,
    	'cat_list' => $cat_list,
    ]) ?>

</div>
