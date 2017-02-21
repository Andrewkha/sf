<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:47 PM
 */

namespace app\modules\admin\resources\gameCalculator;


use app\modules\admin\models\Game;

class StandardCalculator implements GamePointCalculatorInterface
{
    const RESULT_DRAW = 1;
    const RESULT_WIN = 3;
    const RESULT_LOSE = 0;

    public function getGamePoints(Game $game)
    {
        if ($game->scoreHome === NULL || $game->scoreGuest === NULL) {
            $game->setPointsHome(NULL);
            $game->setPointsGuest(NULL);
            return $game;
        }

        if ($game->scoreHome > $game->scoreGuest) {
            $game->setPointsHome(self::RESULT_WIN);
            $game->setPointsGuest(self::RESULT_LOSE);
            return $game;
        }

        if ($game->scoreHome === $game->scoreGuest) {
            $game->setPointsHome(self::RESULT_DRAW);
            $game->setPointsGuest(self::RESULT_DRAW);
            return $game;
        }

        $game->setPointsHome(self::RESULT_LOSE);
        $game->setPointsGuest(self::RESULT_WIN);

        return $game;
    }

}