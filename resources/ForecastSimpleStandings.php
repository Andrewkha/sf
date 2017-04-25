<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/1/2017
 * Time: 5:16 PM
 */

namespace app\resources;

use app\modules\admin\models\Tournament;
use yii\helpers\ArrayHelper;

class ForecastSimpleStandings implements ForecastStandingsInterface
{
    use ForecastStandingsGetDataTrait;

    public function getStandings(Tournament $tournament)
    {
        $items = $this->getData($tournament);
        ArrayHelper::multisort($items, ['totalPoints', 'guessExactScore', 'pointsPerForecast'], [SORT_DESC, SORT_DESC, SORT_DESC], [SORT_NUMERIC, SORT_NUMERIC, SORT_NUMERIC]);

        return $items;
    }

    public function getWinners(Tournament $tournament)
    {
        $standings = $this->getStandings($tournament);

        return array_slice($standings, 0, 3, true);
    }

    public function getWinner(Tournament $tournament)
    {
        $standings = $this->getStandings($tournament);

        return array_slice($standings, 0, 1, true);
    }
}