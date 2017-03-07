<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 22.02.2017
 * Time: 21:54
 */

namespace app\modules\admin\widgets;

use app\resources\ForecastStandingsInterface;
use app\traits\ContainerAwareTrait;
use kartik\base\Widget;
use app\modules\admin\models\Tournament;
use yii\data\ArrayDataProvider;
use app\modules\admin\models\UserTournament;
use app\modules\admin\resources\forecastCalculator\ForecastPointsCalculator;
use app\resources\dto\ForecastDetailsGame;
use app\resources\dto\ForecastStandingsItem;
use app\resources\dto\Tour;
use app\modules\admin\models\Forecast;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\query\ForecastQuery;
use app\modules\admin\models\query\UserTournamentQuery;

class TournamentForecasters extends Widget
{
    public $tournament;

    protected $forecastStandings;
    protected $forecastQuery;
    protected $userTournamentQuery;
    protected $gameQuery;
    protected $games;

    public function __construct(GameQuery $gameQuery, ForecastQuery $forecastQuery, UserTournamentQuery $userTournamentQuery, ForecastStandingsInterface $forecastStandings, array $config = [])
    {
        $this->forecastStandings = $forecastStandings;
        $this->forecastQuery = $forecastQuery;
        $this->userTournamentQuery = $userTournamentQuery;
        $this->gameQuery = $gameQuery;
        parent::__construct($config);
    }

    use ContainerAwareTrait;

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $items = $this->forecastStandings->getStandings($this->getData());

        $models = new ArrayDataProvider([
            'allModels' => $items,
        ]);

        $games = ArrayHelper::index($this->games, 'id', 'tour');

        return $this->render('/widgets/forecastStandings', ['models' => $models, 'tournament' => $tournament, 'games' => $games]);
    }

    protected function getData()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;

        $items = [];

        /** @var ForecastPointsCalculator $calculator */
        $calculator = $this->make(ForecastPointsCalculator::class,[$tournament]);

        $users = $this->userTournamentQuery->whereTournament($tournament->id)->with('user')->all();
        $games = $this->gameQuery->whereTournament($tournament->id)->with(['teamHome', 'teamGuest'])->indexBy('id')->all();
        $this->games = $games;

        $gamesInTour = (new \yii\db\Query())->select('tour, COUNT(*) as gamesintour')->from('{{%game}}')->where(['tournament_id' => $tournament->id])->indexBy('tour')->groupBy('tour')->all();

        foreach ($users as $user) {
            /** @var UserTournament $user */
            $forecasts[$user->user_id] = $this->forecastQuery
                ->where(['user_id' => $user->user_id])
                ->andWhere(['in', 'game_id', array_keys($games)])
                ->all();

            $totalPoints = 0;

            /** @var Tour[] $tours */
            $tours = [];

            foreach ($forecasts[$user->user_id] as $forecast) {
                /** @var Forecast $forecast */
                $forecast->setForecastPoints($calculator, $games[$forecast->game_id]);
                $totalPoints += $forecast->getForecastPoints();
                $tour = $games[$forecast->game_id]->tour;
                if(!key_exists($tour, $tours))
                    $tours[$tour] = $this->make(Tour::class);
                $tours[$tour]->tourPoints += $forecast->getForecastPoints();
                $tours[$tour]->tourGames[$forecast->game_id] = $this->make(ForecastDetailsGame::class, [$forecast->fscoreHome, $forecast->fscoreGuest, $forecast->getForecastPoints()]);
                $tours[$tour]->getTourForecastStatus($gamesInTour[$tour]['gamesintour']);
            }

            $item = $this->make(ForecastStandingsItem::class, [$user->user, $totalPoints, $tours]);
            $items[] = $item;
        }

        return $items;
    }
}