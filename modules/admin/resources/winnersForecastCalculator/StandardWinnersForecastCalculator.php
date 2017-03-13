<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/13/2017
 * Time: 4:19 PM
 */

namespace app\modules\admin\resources\winnersForecastCalculator;

use app\modules\admin\models\Team;
use app\modules\admin\models\TournamentWinnerForecast;

class StandardWinnersForecastCalculator implements WinnersForecastCalculatorInterface
{
    const WFE_TEAM_IN_WINNERS = 1;
    const WFE_TEAM_POSITION = 2;
    const WFE_ALL_3_WINNERS = 3;

    const POINTS_TEAM_IN_WINNERS = 10;
    const POINTS_TEAM_POSITION = 20;
    const POINTS_ALL_3_WINNERS = 20;

    /**
     * @param Team[] $winners
     * @param TournamentWinnerForecast[] $forecast
     * @return array
     */
    public function getWinnersForecastResult($winners, $forecast)
    {
        // TODO: Implement getWinnersForecastResult() method.
    }
}