<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '添加会员';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common'); ?>

<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'rank_list' => $rank_list,
    	'manager_list' => $manager_list,
    	'admin_user' => $admin_user,
    	'city_option' => $city_option,
    ]) ?>

</div>
