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
    public $guessExactScore;

    /**
     * ForecastStandingsItem constructor.
     * @param User $user
     * @param $totalPoints
     * @param ArrayDataProvider $tours
     * @param $guessExactScore
     */
    public function __construct(User $user, $totalPoints, $tours, $guessExactScore)
    {
        $this->user = $user;
        $this->totalPoints = $totalPoints;
        $this->tours = $tours;
        $this->guessExactScore = $guessExactScore;
    }
}