<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/1/2017
 * Time: 5:38 PM
 */

namespace app\modules\admin\resources\winnersForecastCalculator;

use app\modules\admin\models\Team;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\TournamentWinnerForecast;
use app\resources\dto\WinnersForecastItem;
use app\modules\user\models\User;

interface WinnersForecastCalculatorInterface
{
    /**
     * @param Tournament $tournament
     * @param User $user
     * @return WinnersForecastItem[]
     */
    public function getWinnersForecastResult(Tournament $tournament, User $user);

}