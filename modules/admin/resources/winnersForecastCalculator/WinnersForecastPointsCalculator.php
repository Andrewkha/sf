<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/13/2017
 * Time: 4:29 PM
 */

namespace app\modules\admin\resources\winnersForecastCalculator;

use app\modules\admin\resources\forecastCalculator\StandardForecastPointsCalculator;
use app\traits\ContainerAwareTrait;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\Team;
use app\modules\admin\models\TournamentWinnerForecast;

/**
 * Class WinnersForecastPointsCalculator
 * @package app\modules\admin\resources\winnersForecastCalculator
 * @property WinnersForecastCalculatorInterface $calculator
 */
class WinnersForecastPointsCalculator
{
    use ContainerAwareTrait;
    private $tournament;
    private $calculator;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->calculator = $this->getCalculator();
    }

    /**
     * @return WinnersForecastCalculatorInterface;
     */
    private function getCalculator()
    {
        /** @var WinnersForecastCalculatorInterface $calculator */
        $calculator = $this->make(StandardWinnersForecastCalculator::class);
        return $calculator;
    }

    /**
     * @param Team[] $winners
     * @param TournamentWinnerForecast[] $forecast
     * @return array
     */

    public function getWinnersForecastResult($winners, $forecast)
    {
        return $this->calculator->getWinnersForecastResult($winners, $forecast);
    }
}