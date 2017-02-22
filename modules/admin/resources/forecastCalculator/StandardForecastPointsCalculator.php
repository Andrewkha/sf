<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 22.02.2017
 * Time: 22:23
 */

namespace app\modules\admin\resources\forecastCalculator;


use app\modules\admin\models\Forecast;
use app\modules\admin\models\Game;
use app\modules\admin\models\query\GameQuery;

class StandardForecastPointsCalculator implements ForecastPointsCalculatorInterface
{
    public function setForecastPoints(Game $game)
    {
        $forecasts = $game->getForecasts()->all();

    }
}