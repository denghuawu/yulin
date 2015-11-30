<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\WorkReport */

$this->title = 'Create Work Report';
$this->params['breadcrumbs'][] = ['label' => 'Work Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
