<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/13/2017
 * Time: 3:33 PM
 */

namespace app\resources;

use app\modules\admin\resources\gameCalculator\GamePointsCalculator;
use app\traits\ContainerAwareTrait;
use app\modules\admin\models\Game;
use app\resources\dto\Match;
use app\modules\admin\models\Team;
use app\resources\dto\StandingsItem;

trait StandingsGetDataTrait
{
    use ContainerAwareTrait;

    public function getData($tournament)
    {
        $items = [];

        $games = $tournament->getGames()->finishedGamesWithTeams()->orderBy(['tour' => SORT_ASC])->all();
        $participants = $tournament->teams;
        /** @var GamePointsCalculator $calculator */
        $calculator = $this->make(GamePointsCalculator::class, [$tournament]);

        foreach ($participants as $team) {
            /** @var Team $team */
            $gamesPlayed = 0;
            $points = 0;
            $goalsScored = 0;
            $goalsMissed = 0;
            $matches = [];
            if (!empty($games)) {
                foreach ($games as $game) {

                    /**@var $game Game */
                    $game->setPointsGame($calculator);
                    if ($game->teamHome_id === $team->id) {
                        $gamesPlayed++;
                        $points += $game->pointsHome;
                        $goalsScored += $game->scoreHome;
                        $goalsMissed += $game->scoreGuest;
                        $scored = $game->scoreHome;
                        $missed = $game->scoreGuest;
                        $title = $game->teamHome->team . ' - ' . $game->teamGuest->team . ' ' . $game->scoreHome . ' : ' . $game->scoreGuest;
                        $matches[$game->tour] = $this->make(Match::class, [$game->tour, $game->date, $scored, $missed, $title]);
                    } elseif ($game->teamGuest_id === $team->id) {
                        $gamesPlayed++;
                        $points += $game->pointsGuest;
                        $goalsScored += $game->scoreGuest;
                        $goalsMissed += $game->scoreHome;
                        $scored = $game->scoreGuest;
                        $missed = $game->scoreHome;
                        $title = $game->teamHome->team . ' - ' . $game->teamGuest->team . ' ' . $game->scoreHome . ' : ' . $game->scoreGuest;
                        $matches[$game->tour] = $this->make(Match::class, [$game->tour, $game->date, $scored, $missed, $title]);
                    }
                }
            }
            /** @var StandingsItem $item */
            $item = $this->make(StandingsItem::class, [$team, $gamesPlayed, $points, $goalsScored, $goalsMissed, $matches]);
            $item->gameOutcome();
            $items[] = $item;
        }

        return $items;
    }
}