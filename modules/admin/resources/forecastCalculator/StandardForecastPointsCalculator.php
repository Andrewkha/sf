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

    const FORECAST_FULL_MATCH = 3;
    const FORECAST_SCORE_DIFF = 2;
    const FORECAST_WINNER = 1;
    const FORECAST_NONE = 0;

    public function setForecastPoints(Forecast $forecast, Game $game)
    {
        /** @var Game $game */
      //  $game = $forecast->game;

        if (!$game->isFinished())
            return NULL;

        if ($game->scoreHome === $forecast->fscoreHome && $game->scoreGuest === $forecast->fscoreGuest) return self::FORECAST_FULL_MATCH;
        if (($game->scoreHome - $game->scoreGuest) === ($forecast->fscoreHome - $forecast->fscoreGuest)) return self::FORECAST_SCORE_DIFF;
        if ((($game->scoreHome - $game->scoreGuest) > 0 && ($forecast->fscoreHome - $forecast->fscoreGuest) > 0)
            || (($game->scoreHome - $game->scoreGuest) < 0 && ($forecast->fscoreHome - $forecast->fscoreGuest) < 0)) return self::FORECAST_WINNER;

        return self::FORECAST_NONE;
    }
}