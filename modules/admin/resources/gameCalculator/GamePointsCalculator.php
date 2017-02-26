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
use app\traits\ContainerAwareTrait;

/**
 * Class GamePointsCalculator
 * @package app\modules\admin\resources\gameCalculator
 *
 * @property Tournament $tournament
 * @property GamePointCalculatorInterface $calculator
 */


class GamePointsCalculator
{
    use ContainerAwareTrait;
    private $tournament;
    private $calculator;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->calculator = $this->getCalculator();
    }

    private function getCalculator()
    {
        if ($this->tournament->isRegular()) {
            return $this->make(StandardCalculator::class);
        } else {
            return $this->make(PlayOffCalculator::class);
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
}