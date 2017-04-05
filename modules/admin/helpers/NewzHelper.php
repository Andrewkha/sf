<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 12:15 PM
 */

namespace app\modules\admin\helpers;

use yii\helpers\ArrayHelper;
use app\modules\admin\models\Newz;

class NewzHelper
{
    public static function getTypeList()
    {
        return [
            Newz::STATUS_ACTIVE => 'Активная',
            Newz::STATUS_ARCHIVED => 'В архиве',
        ];
    }

    public static function getTypeFriendly($type)
    {
        return ArrayHelper::getValue(self::getTypeList(), $type);
    }
}