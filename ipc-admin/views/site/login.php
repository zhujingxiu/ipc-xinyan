<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;


$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">

    <div class="login-logo">
        <a href="#"><b><?php echo Html::encode(Yii::$app->config->get('siteName')); ?></b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"></p>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form->field($model, 'username',$fieldOptions1)
                ->label()
                ->textInput(['placeholder' => $model->getAttributeLabel('username')])?>

            <?= $form->field($model, 'password', $fieldOptions2)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
                ->label() ?>

        <div class="row">
            <div class="col-xs-8">

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
                <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

