<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FieldOption */

$this->title = 'Update Field Option: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Field Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('../layouts/common'); ?>
<div class="field-option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    		'parent_option' => $parent_option,
    ]) ?>

</div>
