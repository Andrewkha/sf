<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 26.02.2017
 * Time: 19:38
 */

namespace app\modules\admin\resources\forecastCalculator;


use app\modules\admin\models\Forecast;
use app\modules\admin\models\Game;
use app\modules\admin\models\Tournament;
use app\traits\ContainerAwareTrait;

/**
 * Class ForecastPointsCalculator
 * @property ForecastPointsCalculatorInterface $forecastCalculator
 * @property $exactScorePoints number of points provided for guessing the exact score. Using to detect better forecaster when the total points are the same
 * @package app\modules\admin\resources\forecastCalculator
 */
class ForecastPointsCalculator
{
    use ContainerAwareTrait;

    public $exactScorePoints;
    private $forecastCalculator;
    private $tournament;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->forecastCalculator = $this->getCalculator();
        $class = get_class($this->forecastCalculator);
        $this->exactScorePoints = $class::FORECAST_FULL_MATCH;
    }

    public function setForecastPoints(Forecast $forecast, Game $game)
    {
        return $this->forecastCalculator->setForecastPoints($forecast, $game);
    }

    private function getCalculator()
    {
        return $this->make(StandardForecastPointsCalculator::class);
    }
}