<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/1/2017
 * Time: 5:38 PM
 */

namespace app\modules\admin\resources\winnersForecastCalculator;

use app\modules\admin\models\Team;
use app\modules\admin\models\TournamentWinnerForecast;

interface WinnersForecastCalculatorInterface
{
    /**
     * @param Team[] $winners
     * @param TournamentWinnerForecast[] $forecast
     * @return array
     */
    public function getWinnersForecastResult($winners, $forecast);

}