<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 12:56 PM
 */

namespace app\modules\admin\widgets;

use app\modules\admin\models\Tournament;
use app\resources\StandingsInterface;
use app\traits\ContainerAwareTrait;
use kartik\base\Widget;
use yii\data\ArrayDataProvider;
use app\modules\admin\models\Team;
use app\modules\admin\resources\gameCalculator\GamePointsCalculator;
use app\modules\admin\models\Game;
use app\resources\dto\StandingsItem;
use app\resources\dto\Match;

/**
 * Class TournamentStandings
 * @package app\modules\admin\widgets
 *
 * @property Tournament $tournament
 *
 */

class TournamentStandings extends Widget
{
    const MODE_ADMIN = 1;
    const MODE_USER = 0;

    use ContainerAwareTrait;

    public $tournament;
    public $mode;
    protected $standings;

    public function __construct(StandingsInterface $standings, array $config = [])
    {
        parent::__construct($config);
        $this->standings = $standings;
    }

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $items = $this->standings->getStandings($this->getData());

        $models = new ArrayDataProvider([
            'allModels' => $items,
        ]);

        return $this->render('/widgets/standings', ['models' => $models, 'tournament' => $tournament, 'mode' => $this->mode]);

    }

    protected function getData()
    {
        $tournament = $this->tournament;
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