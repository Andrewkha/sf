<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/6/2017
 * Time: 3:06 PM
 */

namespace app\resources\dto;


class ForecastDetailsGame
{
    public $forecastHome;
    public $forecastGuest;
    public $forecastPoints;

    public function __construct($forecastHome, $forecastGuest, $forecastPoints)
    {
        $this->forecastHome = $forecastHome;
        $this->forecastGuest = $forecastGuest;
        $this->forecastPoints = $forecastPoints;
    }
}