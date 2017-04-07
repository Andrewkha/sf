<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/7/2017
 * Time: 3:50 PM
 */

namespace app\modules\admin\helpers;

use app\modules\admin\models\Log;
use yii\log\Logger;
use yii\helpers\ArrayHelper;

class LogHelper
{
    public static function getTypeList()
    {
        return [
            Log::CATEGORY_CONSOLE => 'Консоль',
            Log::CATEGORY_APPLICATION => 'Веб',
        ];
    }

    public static function getStatuses()
    {
        return [
            Logger::LEVEL_ERROR => 'Ошибка',
            Logger::LEVEL_INFO => 'Информация',
            Logger::LEVEL_WARNING => 'Предупреждение',
            Logger::LEVEL_TRACE => 'Отладочная информация',
        ];
    }

    public static function getType($type)
    {
        return ArrayHelper::getValue(self::getTypeList(), $type);
    }

    public static function getStatus($status)
    {
        return ArrayHelper::getValue(self::getStatuses(), $status);
    }
}