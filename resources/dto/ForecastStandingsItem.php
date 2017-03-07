<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/2/2017
 * Time: 10:13 PM
 */

namespace app\resources\dto;


use app\modules\user\models\User;

class ForecastStandingsItem
{
    public $user;
    public $tours;
    public $totalPoints;

    /**
     * ForecastStandingsItem constructor.
     * @param User $user
     * @param $totalPoints
     * @param Tour[] $tours
     */
    public function __construct(User $user, $totalPoints, $tours)
    {
        $this->user = $user;
        $this->totalPoints = $totalPoints;
        $this->tours = $tours;
    }
}