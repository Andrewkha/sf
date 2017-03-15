<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/2/2017
 * Time: 10:13 PM
 */

namespace app\resources\dto;


use app\modules\user\models\User;
use yii\data\ArrayDataProvider;

class ForecastStandingsItem
{
    public $user;
    public $tours;
    public $totalPoints;
    public $pointsPerForecast;
    public $guessExactScore;
    public $winnersForecast;
    public $winnersForecastResult;

    /**
     * ForecastStandingsItem constructor.
     * @param User $user
     * @param $totalPoints
     * @param ArrayDataProvider $tours
     * @param $guessExactScore
     * @param ArrayDataProvider $winnersForecast
     * @param array $winnersForecastResult
     */
    public function __construct(User $user, $totalPoints,$pointsPerForecast, ArrayDataProvider $tours, $guessExactScore, ArrayDataProvider $winnersForecast, $winnersForecastResult)
    {
        $this->user = $user;
        $this->totalPoints = $totalPoints;
        $this->pointsPerForecast = $pointsPerForecast;
        $this->tours = $tours;
        $this->guessExactScore = $guessExactScore;
        $this->winnersForecast = $winnersForecast;
        $this->winnersForecastResult = $winnersForecastResult;
    }
}