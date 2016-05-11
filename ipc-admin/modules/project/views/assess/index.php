<?php

use ipc\modules\project\Module as msgModule;
use kartik\tree\TreeView;
use ipc\modules\project\modules\config\models\Status;
use ipc\modules\project\models\Assess;

/* @var $this yii\web\View */
/* @var $searchModel ipc\modules\project\models\AssessSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = msgModule::t('assess', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
.kv-detail-container{padding:0px;border:none;}
.select2-container .select2-selection--single .select2-selection__rendered{margin-top:0px;}
.kv-child-table-row th,.kv-child-table-row td{border-top: 1px #ddd solid;}
");
?>
<div class="assess-index">
    <?php echo TreeView::widget([
        'query' => Assess::find()->where(['status'=>Status::getValue(Status::CONFIRMED)])->addOrderBy('level desc,addtime desc'),
        'fontAwesome' => true,
        'isAdmin' => false,
        'displayValue' => empty(Yii::$app->session['currentProject']) ? Assess::getFirstNode(Status::getValue(Status::CONFIRMED)) : Yii::$app->session['currentProject'],
        'cacheSettings' => [
            'enableCache' => false   // defaults to true
        ],
        'nodeView' => '@ipc/modules/project/views/assess/detail',
        'rootOptions' => [
            'label'=>msgModule::t('assess', 'Projects'),  // custom root label
            'class'=>'text-success'
        ],
        'treeOptions' => [
            'style' => 'height:620px',

        ],
        'iconEditSettings' =>[
            'type' => TreeView::ICON_RAW
        ],
        'toolbar' => [
            TreeView::BTN_CREATE => false,
            TreeView::BTN_CREATE_ROOT => false,
            TreeView::BTN_REMOVE => false,
            TreeView::BTN_MOVE_UP => false,
            TreeView::BTN_MOVE_DOWN => false,
            TreeView::BTN_MOVE_LEFT => false,
            TreeView::BTN_MOVE_RIGHT => false,
        ]
    ]);

    ?>
</div>