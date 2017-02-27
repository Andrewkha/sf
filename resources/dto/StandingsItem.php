<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 2:39 PM
 */

namespace app\resources\dto;

use app\modules\admin\models\Team;

/**
 * Class StandingsItem
 * @package app\modules\admin\widgets\dto
 * @property Match[] $matches
 * @property Team $team
 */
class StandingsItem
{
    public $team;
    public $gamesPlayed;
    public $points;
    public $goalsScored;
    public $goalsMissed;
    public $matches;
    public $gamesWin = 0;
    public $gamesLost = 0;
    public $gamesDraw = 0;

    public function __construct(Team $team, $gamesPlayed, $points, $goalsScored, $goalsMissed, $matches)
    {
        $this->team = $team;
        $this->gamesPlayed= $gamesPlayed;
        $this->points = $points;
        $this->goalsScored = $goalsScored;
        $this->goalsMissed = $goalsMissed;
        $this->matches = $matches;
    }

    public function gameOutcome()
    {
        foreach ($this->matches as &$one)
        {
            if ($one->scored > $one->missed){
                $one->outcome = Match::GAME_WIN;
                $this->gamesWin++;
            }

            elseif ($one->scored < $one->missed) {
                $one->outcome = Match::GAME_LOSE;
                $this->gamesLost++;
            }

            else {
                $one->outcome = Match::GAME_DRAW;
                $this->gamesDraw++;
            }
        }
        return;
    }
}