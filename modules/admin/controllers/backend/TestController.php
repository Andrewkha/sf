<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/25/2017
 * Time: 3:20 PM
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\Tournament;
use app\modules\admin\Module;
use app\modules\user\models\User;
use app\resources\ForecastStandingsInterface;
use app\traits\ContainerAwareTrait;
use yii\web\Controller;
use app\modules\admin\widgets\TournamentForecasters;
use Yii;

class TestController extends Controller
{

    use ContainerAwareTrait;

    protected $standings;

    public function actionTest()
    {
        $tournament = Tournament::findOne(17);

        /** @var User[] $users */
        $users = User::find()->tournamentNotificationsSubscribers($tournament->id)->all();

        /** @var ForecastStandingsInterface $forecastStandings */
        $forecastStandings = $this->make(ForecastStandingsInterface::class, [$tournament]);

        foreach ($users as $user)
            print_r($forecastStandings->getPosition($user));
    }
}