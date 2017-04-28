<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 2:31 PM
 */

namespace app;

use app\modules\admin\models\Forecast;
use app\modules\admin\models\ForecastReminders;
use app\modules\admin\models\Newz;
use app\modules\admin\models\query\ForecastQuery;
use app\modules\admin\models\query\ForecastRemindersQuery;
use app\modules\admin\models\query\NewzQuery;
use app\modules\admin\models\query\TeamQuery;
use app\modules\admin\models\query\TeamTournamentQuery;
use app\modules\admin\models\query\TournamentQuery;
use app\modules\admin\models\query\TournamentWinnerForecastQuery;
use app\modules\admin\models\query\UserTournamentQuery;
use app\modules\admin\models\Team;
use app\modules\admin\models\TeamTournament;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\TournamentWinnerForecast;
use app\modules\admin\models\UserTournament;
use app\modules\user\models\query\UserQuery;
use app\modules\user\models\User;
use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\query\TourresultnotificationQuery;
use app\modules\admin\models\Tourresultnotification;
use app\modules\admin\models\query\CountryQuery;
use app\modules\admin\models\Game;
use app\modules\admin\models\Country;
use app\modules\admin\models\Log;
use app\modules\admin\models\query\LogQuery;
use app\resources\ForecastSimpleStandings;
use app\resources\ForecastStandingsInterface;
use app\resources\SimpleStandings;
use app\resources\StandingsInterface;
use Yii;
use yii\base\BootstrapInterface;
use yii\log\Logger;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->initContainer();
    }

    protected function initContainer()
    {
        $container = Yii::$container;

        //Standings Interface
        $container->set(StandingsInterface::class, SimpleStandings::class);
        $container->set(ForecastStandingsInterface::class, ForecastSimpleStandings::class);

        //Query classes

        $container->set(CountryQuery::class, function () {
            return Country::find();
        });
        $container->set(LogQuery::class, function () {
            return Log::find();
        });
        $container->set(NewzQuery::class, function () {
            return Newz::find();
        });
        $container->set(TournamentQuery::class, function () {
            return Tournament::find();
        });
        $container->set(TeamQuery::class, function () {
            return  Team::find();
        });
        $container->set(TeamTournamentQuery::class, function () {
            return TeamTournament::find();
        });
        $container->set(TournamentWinnerForecastQuery::class, function () {
            return TournamentWinnerForecast::find();
        });
        $container->set(ForecastQuery::class, function () {
            return Forecast::find();
        });
        $container->set(UserTournamentQuery::class, function () {
            return UserTournament::find();
        });
        $container->set(UserQuery::class, function () {
            return User::find();
        });
        $container->set(GameQuery::class, function () {
            return Game::find();
        });
        $container->set(ForecastRemindersQuery::class, function () {
            return ForecastReminders::find();
        });
        $container->set(TourresultnotificationQuery::class, function () {
            return Tourresultnotification::find();
        });

        //logger

        $container->set(Logger::class, function () {
            return \Yii::getLogger();
        });
    }
}