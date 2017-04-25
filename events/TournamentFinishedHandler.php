<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/25/2017
 * Time: 1:04 PM
 */

namespace app\events;

use app\modules\admin\models\Tournament;
use app\modules\admin\models\Newz;
use app\modules\admin\widgets\TournamentStandings;
use app\modules\user\models\User;
use app\modules\admin\services\ItemCreateService;
use app\resources\ForecastStandingsInterface;
use app\traits\ContainerAwareTrait;
use Yii;

class TournamentFinishedHandler
{
    /** @var ForecastStandingsInterface */
    protected $forecastStandings;

    use ContainerAwareTrait;

    public function __construct(ForecastStandingsInterface $forecastStandings)
    {
        $this->forecastStandings = $forecastStandings;
    }

    public function tournamentFinishedHandle(Tournament $tournament)
    {
        //getting standings

        $standings = TournamentStandings::widget([
            'tournament' => $tournament,
            'mode' => TournamentStandings::MODE_NEWZ,
        ]);

        //create news first

        $category = $tournament->id;
        $subj = "Закончен турнир " . $tournament->tournament;
        $body = $this->createNewsBody($tournament, $standings);

        /** @var Newz $news */
        $news = $this->make(Newz::class);
        $news->tournament_id = $category;
        $news->subject = $subj;
        $news->body = $body;

        // todo put currently logged on user
        $news->user_id = User::ADMIN_ID;

        $this->make(ItemCreateService::class, [$news])->run();

        //send user notifications

        //mark old news as archived
    }

    protected function createNewsBody(Tournament $tournament, $standings)
    {
        return Yii::$app->controller->renderPartial('/newsTemplates/tournamentFinished', ['tournament' => $tournament, 'standings' => $standings]);
    }
}