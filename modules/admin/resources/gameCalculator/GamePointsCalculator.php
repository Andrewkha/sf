<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:57 PM
 */

namespace app\modules\admin\resources\gameCalculator;

use app\modules\admin\models\Tournament;
use app\modules\admin\models\Game;

/**
 * Class GamePointsCalculator
 * @package app\modules\admin\resources\gameCalculator
 *
 * @property Tournament $tournament
 * @property GamePointCalculatorInterface $calculator
 */


class GamePointsCalculator
{
    private $tournament;
    private $calculator;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->calculator = $this->getCalculator();
    }

    /**
     * @return PlayOffCalculator|StandardCalculator
     */

    private function getCalculator()
    {
        if ($this->tournament->isRegular()) {
            return new StandardCalculator();
        } else {
            return new PlayOffCalculator();
        }
    }

    /**
     * @param Game $game
     * @return mixed
     */

    public function setGamePoints(Game $game)
    {
        return $this->calculator->getGamePoints($game);
    }

    public function setGamesPoints(array $games)
    {
        foreach ($games as &$game) {
            $this->setGamePoints($game);
        }

        return;
    }
}