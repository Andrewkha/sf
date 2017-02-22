<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 2:31 PM
 */

namespace app;

use app\modules\admin\models\query\TeamQuery;
use app\modules\admin\models\query\TeamTournamentQuery;
use app\modules\admin\models\query\TournamentQuery;
use app\modules\admin\models\Team;
use app\modules\admin\models\TeamTournament;
use app\modules\admin\models\Tournament;
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

        //Query classes
        $container->set(TournamentQuery::class, Tournament::find());
        $container->set(TeamQuery::class, Team::find() );
        $container->set(TeamTournamentQuery::class, TeamTournament::find());
    }
}