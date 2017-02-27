<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 1:44 PM
 */

namespace app\resources;

use app\modules\admin\models\Team;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\Game;
use app\resources\dto\Match;
use app\resources\dto\StandingsItem;
use app\traits\ContainerAwareTrait;
use yii\helpers\ArrayHelper;

class SimpleStandings implements StandingsInterface
{
    /**
     * @param Team[] $participants
     * @param Game[] $games
     * @return StandingsItem[] $items
     */

    use ContainerAwareTrait;

    public function getStandings(Tournament $tournament)
    {
        $items = [];

        $games = $tournament->getGames()->finishedGames()->orderBy(['tour' => SORT_ASC])->all();
        $participants = $tournament->getTeams()->all();

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
                    if ($game->teamHome_id === $team->id) {
                        $gamesPlayed++;
                        $points += $game->pointsHome;
                        $goalsScored += $game->scoreHome;
                        $goalsMissed += $game->scoreGuest;
                        $scored = $game->scoreHome;
                        $missed = $game->scoreGuest;
                        $title = $game->teamHome->team . ' - ' . $game->scoreHome . ' ' . $game->scoreHome . ' : ' . $game->scoreGuest;
                        $matches[$game->tour] = $this->make(Match::class, [$game->tour, $game->date, $scored, $missed, $title]);
                    } elseif ($game->teamGuest_id === $team->id) {
                        $gamesPlayed++;
                        $points += $game->pointsGuest;
                        $goalsScored += $game->scoreGuest;
                        $goalsMissed += $game->scoreHome;
                        $scored = $game->scoreGuest;
                        $missed = $game->scoreHome;
                        $title = $game->teamHome->team . ' - ' . $game->scoreHome . ' ' . $game->scoreHome . ' : ' . $game->scoreGuest;
                        $matches[$game->tour] = $this->make(Match::class, [$game->tour, $game->date, $scored, $missed, $title]);
                    }
                }
            }
            /** @var StandingsItem $item */
            $item = $this->make(StandingsItem::class, [$team, $gamesPlayed, $points, $goalsScored, $goalsMissed, $matches]);
            $item->gameOutcome();
            $items[] = $item;
        }
        ArrayHelper::multisort($items, ['points', 'gamesWin', 'gamesLost'], [SORT_DESC, SORT_DESC, SORT_ASC], [SORT_NUMERIC, SORT_NUMERIC, SORT_NUMERIC]);

        return $items;
    }
}