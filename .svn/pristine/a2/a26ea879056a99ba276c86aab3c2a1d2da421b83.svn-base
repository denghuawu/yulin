<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Brand */

$this->title = '添加品牌';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common'); ?>

<div class="brand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'brand_list'=>$brand_list,
    	'cat_list' => $cat_list,
    ]) ?>

</div>
