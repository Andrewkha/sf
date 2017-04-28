<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/1/2017
 * Time: 5:16 PM
 */

namespace app\resources;

use app\modules\admin\models\Tournament;
use app\modules\user\models\User;
use yii\helpers\ArrayHelper;

class ForecastSimpleStandings implements ForecastStandingsInterface
{
    use ForecastStandingsGetDataTrait;

    private $standings;

    public function __construct(Tournament $tournament)
    {
        $items = $this->getData($tournament);
        ArrayHelper::multisort($items, ['totalPoints', 'guessExactScore', 'pointsPerForecast'], [SORT_DESC, SORT_DESC, SORT_DESC], [SORT_NUMERIC, SORT_NUMERIC, SORT_NUMERIC]);

        $this->standings = $items;
    }

    public function getStandings()
    {
        return $this->standings;
    }

    public function getWinners()
    {
        return array_slice($this->standings, 0, 3, true);
    }

    public function getWinner()
    {
        return array_slice($this->standings, 0, 1, true);
    }

    public function getPosition(User $user)
    {
        return array_search($user->username, ArrayHelper::getColumn($this->standings, 'user.username'));
    }
}