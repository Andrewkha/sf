<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 26.02.2017
 * Time: 19:38
 */

namespace app\modules\admin\resources\forecastCalculator;


use app\modules\admin\models\Forecast;
use app\traits\ContainerAwareTrait;

/**
 * Class ForecastPointsCalculator
 * @property ForecastPointsCalculatorInterface $forecastCalculator
 * @package app\modules\admin\resources\forecastCalculator
 */
class ForecastPointsCalculator
{
    use ContainerAwareTrait;
    private $forecastCalculator;

    public function __construct()
    {
        $this->forecastCalculator = $this->getCalculator();
    }

    public function setForecastPoints(Forecast $forecast)
    {
        return $this->forecastCalculator->setForecastPoints($forecast);
    }

    private function getCalculator()
    {
        return $this->make(StandardForecastPointsCalculator::class);
    }
}