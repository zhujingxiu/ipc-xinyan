<?php

namespace system\modules\auth\models;

use Yii;

/**
 * This is the model class for table "{{%auth_node}}".
 *
 * @property integer $node_id
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $icon
 * @property integer $icon_type
 * @property string $mode
 * @property string $path
 * @property string $rule
 * @property string $rule_param
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 */
class Permission extends \system\modules\auth\models\Node
{
    public function init()
    {
        parent::init();
        $this->mode = SELF::MODE_PERMISSION;
    }
}
