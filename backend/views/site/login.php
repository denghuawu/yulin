<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../layouts/common') ?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'user_name') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?php //ehco  $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php if(yii::$app->session->getFlash('warnning')):?>
    <div style='color:red'>
        <?php echo yii::$app->session->getFlash('warnning'); yii::$app->session->setFlash('warnning',null); ?>
    </div>
<?php endif; ?>
