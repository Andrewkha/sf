<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/7/2017
 * Time: 5:49 PM
 */

namespace app\modules\admin\helpers;

use app\modules\admin\models\Tournament;
use yii\helpers\ArrayHelper;

class TournamentHelper
{
    public static function getTypeList()
    {
        return [
            Tournament::TYPE_PLAYOFF => 'Плейофф',
            Tournament::TYPE_REGULAR => 'Круговой',
        ];
    }

    public static function getTypeFriendly($type)
    {
        return ArrayHelper::getValue(self::getTypeList(), $type);
    }

    public static function getStatusList()
    {
        return [
            Tournament::STATUS_NOT_STARTED => 'Не начался',
            Tournament::STATUS_IN_PROGRESS => 'Проходит',
            Tournament::STATUS_FINISHED => 'Закончен',
        ];
    }

    public static function getStatusFriendly($status)
    {
        return ArrayHelper::getValue(self::getStatusList(), $status);
    }
}