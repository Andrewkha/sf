<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/8/2017
 * Time: 5:55 PM
 */

namespace app\modules\admin\forms;

use yii\base\Model;
use app\modules\admin\models\Tournament;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Country;

class TournamentCreateEditForm extends Model
{

    public static function getCountriesArray()
    {
        return ArrayHelper::map(Country::find()->orderBy(['country' => SORT_ASC])->asArray()->all(), 'id', 'country');
    }
}