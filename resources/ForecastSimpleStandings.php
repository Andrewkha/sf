<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/1/2017
 * Time: 5:16 PM
 */

namespace app\resources;

use yii\helpers\ArrayHelper;

class ForecastSimpleStandings implements ForecastStandingsInterface
{

    public function getStandings($items)
    {
        ArrayHelper::multisort($items, 'totalPoints', SORT_DESC, SORT_NUMERIC);

        return $items;
    }

}