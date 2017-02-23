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
        $result = [
            'pointsHome' => NULL,
            'pointsGuest' => NULL
        ];

        if ($game->scoreHome === NULL || $game->scoreGuest === NULL) {
            return $result;
        }

        if ($game->scoreHome > $game->scoreGuest) {
            $result['pointsHome'] = self::RESULT_WIN;
            $result['pointsGuest'] = self::RESULT_LOSE;

            return $result;
        }

        if ($game->scoreHome === $game->scoreGuest) {
            $result['pointsHome'] = self::RESULT_DRAW;
            $result['pointsGuest'] = self::RESULT_DRAW;
            return $result;
        }

        $result['pointsHome'] = self::RESULT_LOSE;
        $result['pointsGuest'] = self::RESULT_WIN;

        return $result;
    }

}