<?php

/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 22.02.2017
 * Time: 22:19
 */
namespace app\modules\admin\resources\forecastCalculator;

use app\modules\admin\models\Forecast;
use app\modules\admin\models\Game;

interface ForecastPointsCalculatorInterface
{
    public function setForecastPoints(Forecast $forecast, Game $game);
}