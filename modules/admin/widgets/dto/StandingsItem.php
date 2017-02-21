<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 2:39 PM
 */

namespace app\modules\admin\widgets\dto;

use app\modules\admin\models\Team;

/**
 * Class StandingsItem
 * @package app\modules\admin\widgets\dto
 * @property Team $team
 */
class StandingsItem
{
    public $position;
    public $team;
    public $gamesPlayed;
    public $points;

    public function __construct(Team $team, $gamesPlayed, $points)
    {
        $this->team = $team;
        $this->gamesPlayed= $gamesPlayed;
        $this->points = $points;
    }
}