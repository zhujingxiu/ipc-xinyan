<?php

use yii\helpers\Html;
use kartik\tree\TreeView;
use system\modules\auth\models\Menu;

use system\modules\auth\Module;
/* @var $this yii\web\View */


$this->title = Module::t('auth', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('auth', 'Create Node'), ['create'], ['class' => 'btn btn-success hidden']) ?>
    </p>
    <?php /* echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'node_id',
            'pid',
            'lft',
            'rgt',
            'lvl',
            // 'name',
            // 'icon',
            // 'icon_type',
            // 'active',
            // 'selected',
            // 'disabled',
            // 'readonly',
            // 'visible',
            // 'collapsed',
            // 'movable_u',
            // 'movable_d',
            // 'movable_l',
            // 'movable_r',
            // 'removable',
            // 'removable_all',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */ ?>

    <?php
    echo TreeView::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => $model->find()->where(['mode'=>$model->mode])->addOrderBy('parent_id, lft'),
        'nodeAddlViews' => [
            kartik\tree\Module::VIEW_PART_2 => '@system/modules/auth/views/menu/_treePart2'
        ],
        'headingOptions' => ['label' => 'Menu'],
        'fontAwesome' => true,     // optional
        'isAdmin' => false,         // optional (toggle to enable admin mode)
        'displayValue' => $model->getFirstNode(),        // initial display value
        'softDelete' => true,       // defaults to true
        'cacheSettings' => [
            'enableCache' => true   // defaults to true
        ],
        'nodeView' => '@system/modules/auth/views/node/_form',
        'treeOptions' => [
            'style' => 'height:600px'
        ]
    ]);

    ?>
</div>
