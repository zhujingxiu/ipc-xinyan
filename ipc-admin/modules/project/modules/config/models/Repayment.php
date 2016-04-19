<?php

namespace ipc\modules\project\modules\config\models;

use Yii;

/**
 * This is the model class for table "{{%project_repayment}}".
 *
 * @property integer $repayment_id
 * @property string $title
 * @property string $code
 * @property integer $status
 */
class Repayment extends \system\libs\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project_repayment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repayment_id', 'title', 'code', 'status'], 'required'],
            [['repayment_id', 'status'], 'integer'],
            [['title', 'code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'repayment_id' => Yii::t('app', 'Repayment ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}