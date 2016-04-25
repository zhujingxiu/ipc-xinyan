<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model system\modules\auth\models\Permission */

$this->title = Yii::t('auth', 'Create Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>