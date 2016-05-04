<?php

namespace ipc\modules\project\modules\config\models;

use Yii;

/**
 * This is the model class for table "{{%project_status}}".
 *
 * @property integer $status_id
 * @property string $title
 * @property string $code
 */
class Status extends \system\libs\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title', 'code'], 'required'],
            [['status_id'], 'integer'],
            [['title', 'code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => Yii::t('app', 'Status ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    public function getStatus($code){
        return Status::find()->where(['code'=>strtolower($code)])->asArray()->one();
    }
}
