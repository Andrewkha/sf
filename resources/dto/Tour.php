<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/6/2017
 * Time: 1:53 PM
 */

namespace app\resources\dto;

/**
 * Class Tour
 * @package app\resources\dto
 * @property ForecastDetailsGame[] $tourGames
 * @property $tourForecastStatus
 */

class Tour
{
    public $tourPoints;
    public $tourGames;
    public $tourForecastStatus;

    const TOUR_FORECAST_COMPLETE = 2;
    const TOUR_FORECAST_PARTIAL = 1;
    const TOUR_FORECAST_EMPTY = 0;

    public function __construct($tourPoints = 0)
    {
        $this->tourPoints = $tourPoints;
    }

    public function getTourForecastStatus($gamesInTour)
    {
        $count = count($this->tourGames);

        if ($gamesInTour == $count)
            $this->tourForecastStatus = self::TOUR_FORECAST_COMPLETE;
        elseif ($count == 0)
            $this->tourForecastStatus = self::TOUR_FORECAST_EMPTY;
        else
            $this->tourForecastStatus = self::TOUR_FORECAST_PARTIAL;
    }
}