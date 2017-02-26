<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 1:05 PM
 */

namespace app\modules\admin\resources\gameCalculator;


use app\modules\admin\models\Game;

class PlayOffCalculator implements GamePointCalculatorInterface
{
    /*
     * Assigning +1 point for win in play off stage
     */
    const RESULT_DRAW = 1;
    const RESULT_WIN = 3;
    const RESULT_LOSE = 0;

    const RESULT_PLAY_OFF_ADDITIONAL = 2;

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
            if ($game->tour > 3)
                $result['pointsHome'] += self::RESULT_PLAY_OFF_ADDITIONAL;
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
        if ($game->tour > 3)
            $result['pointsGuest'] += self::RESULT_PLAY_OFF_ADDITIONAL;

        return $result;
    }

}