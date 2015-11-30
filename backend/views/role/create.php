<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = '添加角色';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common') ?>

<div class="role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'data'=>$data,
    ]) ?>

</div>
