<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 12:56 PM
 */

namespace app\modules\admin\widgets;

use app\modules\admin\models\Tournament;
use app\modules\admin\resources\gameCalculator\GamePointsCalculator;
use app\modules\admin\traits\ContainerAwareTrait;
use app\modules\admin\widgets\dto\StandingsItem;
use kartik\base\Widget;
use app\modules\admin\models\Game;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * Class TournamentStandings
 * @package app\modules\admin\widgets
 *
 * @property Tournament $tournament
 *
 */

class TournamentStandings extends Widget
{
    use ContainerAwareTrait;

    public $tournament;

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $games = $tournament->getGames()->finishedGames()->all();
        $participants = $tournament->getTeams()->all();

        $items = [];

        foreach ($participants as $team) {
            $gamesPlayed = 0;
            $points = 0;
            if (!empty($games)) {
                $games = $this->assignGamePoints($games);
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
        $models = new ArrayDataProvider([
            'allModels' => $items,
        ]);

        return $this->render('/widgets/standings', ['models' => $models, 'tournament' => $tournament]);

    }

    protected function assignGamePoints($games)
    {
        /** @var GamePointsCalculator $calculator */
        $calculator = $this->make(GamePointsCalculator::class, [$this->tournament]);
        return $calculator->setGamesPoints($games);
    }
}