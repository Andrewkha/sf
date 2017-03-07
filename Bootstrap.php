<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 2:31 PM
 */

namespace app;

use app\modules\admin\models\Forecast;
use app\modules\admin\models\query\ForecastQuery;
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
use app\modules\admin\models\Game;
use app\resources\ForecastSimpleStandings;
use app\resources\ForecastStandingsInterface;
use app\resources\SimpleStandings;
use app\resources\StandingsInterface;
use Yii;
use yii\base\BootstrapInterface;

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
        $container->setSingleton(StandingsInterface::class, SimpleStandings::class);
        $container->setSingleton(ForecastStandingsInterface::class, ForecastSimpleStandings::class);

        //Query classes
        $container->set(TournamentQuery::class, Tournament::find());
        $container->set(TeamQuery::class, Team::find() );
        $container->set(TeamTournamentQuery::class, TeamTournament::find());
        $container->set(TournamentWinnerForecastQuery::class, TournamentWinnerForecast::find());
        $container->set(ForecastQuery::class, Forecast::find());
        $container->set(UserTournamentQuery::class, UserTournament::find());
        $container->set(UserQuery::class, User::find());
        $container->set(GameQuery::class, Game::find());
    }
}