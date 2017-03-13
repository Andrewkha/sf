<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/13/2017
 * Time: 4:51 PM
 */

namespace app\resources;

use app\modules\admin\models\query\ForecastQuery;
use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\query\UserTournamentQuery;
use app\modules\admin\models\Tournament;
use app\modules\admin\resources\forecastCalculator\ForecastPointsCalculator;
use app\traits\ContainerAwareTrait;
use app\resources\dto\Tour;
use app\modules\admin\models\Forecast;
use app\modules\admin\models\UserTournament;
use app\resources\dto\ForecastDetailsGame;
use yii\data\ArrayDataProvider;
use app\resources\dto\ForecastStandingsItem;

trait ForecastStandingsGetDataTrait
{
    use ContainerAwareTrait;

    public function getData(Tournament $tournament)
    {
        $items = [];

        /** @var ForecastPointsCalculator $calculator */
        $calculator = $this->make(ForecastPointsCalculator::class,[$tournament]);

        $userTournamentQuery = $this->make(UserTournamentQuery::class);
        $forecastQuery = $this->make(ForecastQuery::class);
        $gameQuery = $this->make(GameQuery::class);
        $games = $gameQuery->whereTournament($tournament->id)->with(['teamHome', 'teamGuest'])->indexBy('id')->all();
        $users = $userTournamentQuery->whereTournament($tournament->id)->with('user')->all();

        $gamesInTour = (new \yii\db\Query())->select('tour, COUNT(*) as gamesintour')->from('{{%game}}')->where(['tournament_id' => $tournament->id])->indexBy('tour')->groupBy('tour')->all();

        foreach ($users as $user) {
            /** @var UserTournament $user */
            $forecasts[$user->user_id] = $forecastQuery
                ->where(['user_id' => $user->user_id])
                ->andWhere(['in', 'game_id', array_keys($games)])
                ->all();

            $totalPoints = 0;
            $guessExactScore = 0;

            /** @var Tour[] $tours */
            $tours = [];

            foreach ($forecasts[$user->user_id] as $forecast) {
                /** @var Forecast $forecast */
                $forecast->setForecastPoints($calculator, $games[$forecast->game_id]);
                $totalPoints += $forecast->getForecastPoints();
                if ($forecast->getForecastPoints() === $calculator->exactScorePoints)
                    $guessExactScore++;
                $tour = $games[$forecast->game_id]->tour;
                if(!key_exists($tour, $tours))
                    $tours[$tour] = $this->make(Tour::class, [$tour]);
                $tours[$tour]->tourPoints += $forecast->getForecastPoints();
                $tours[$tour]->tourGames[$forecast->game_id] = $this->make(ForecastDetailsGame::class, [$forecast->fscoreHome, $forecast->fscoreGuest, $forecast->getForecastPoints()]);
                $tours[$tour]->getTourForecastStatus($gamesInTour[$tour]['gamesintour']);
            }

            /** @var ArrayDataProvider $tourDataProviders */
            $tourDataProvider = new ArrayDataProvider([
                'allModels' => $tours
            ]);

            $item = $this->make(ForecastStandingsItem::class, [$user->user, $totalPoints, $tourDataProvider, $guessExactScore]);
            $items[] = $item;
        }

        return $items;
    }
}