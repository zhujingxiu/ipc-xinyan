<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model system\modules\auth\models\Permission */

$this->title = Yii::t('auth', 'Update {modelClass}: ', [
    'modelClass' => 'Permission',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->node_id]];
$this->params['breadcrumbs'][] = Yii::t('auth', 'Update');
?>
<div class="permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>