<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 1:44 PM
 */

namespace app\resources;

use app\modules\admin\models\Team;
use app\modules\admin\resources\gameCalculator\GamePointsCalculator;
use app\modules\admin\models\Game;
use app\resources\dto\StandingsItem;
use app\traits\ContainerAwareTrait;
use yii\helpers\ArrayHelper;

class SimpleStandings implements StandingsInterface
{
    /**
     * @param GamePointsCalculator $calculator
     * @param Team[] $participants
     * @param Game[] $games
     * @return StandingsItem[] $items
     */

    use ContainerAwareTrait;

    public function getStandings(GamePointsCalculator $calculator, $participants, $games)
    {
        $items = [];

        foreach ($participants as $team) {
            $gamesPlayed = 0;
            $points = 0;
            if (!empty($games)) {
                $games = $calculator->setGamesPoints($games);
                foreach ($games as $game) {
                    /**@var $game Game */
                    if ($game->teamHome_id === $team->id) {
                        $gamesPlayed++;
                        $points += $game->pointsHome;
                    } elseif ($game->teamGuest_id === $team->id) {
                        $gamesPlayed++;
                        $points += $game->pointsGuest;
                    }
                }
            }
            $items[] = $this->make(StandingsItem::class, [$team, $gamesPlayed, $points]);
        }
        ArrayHelper::multisort($items, 'points', SORT_DESC, [SORT_NUMERIC]);

        return $items;
    }
}