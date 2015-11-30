<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '编辑管理员: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?= $this->render('../layouts/common');?>

<div class="admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'data'=>$data,

    ]) ?>

</div>
