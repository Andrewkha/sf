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
use app\modules\admin\widgets\TournamentForecasters;
use app\modules\admin\widgets\TournamentStandings;
use app\modules\user\models\query\UserQuery;
use app\modules\user\models\User;
use app\modules\admin\services\ItemCreateService;
use app\resources\ForecastStandingsInterface;
use app\traits\ContainerAwareTrait;
use app\modules\admin\factory\MailFactory;
use yii\base\Exception;
use Yii;

class TournamentFinishedHandler
{

    use ContainerAwareTrait;

    protected $userQuery;

    public function __construct(UserQuery $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    public function tournamentFinishedHandle(Tournament $tournament)
    {
        //getting standings

        $standings = TournamentStandings::widget([
            'tournament' => $tournament,
            'mode' => TournamentStandings::MODE_NEWZ,
        ]);

        /** @var ForecastStandingsInterface $forecastStandings */
        $forecastStandings = $this->make(ForecastStandingsInterface::class, [$tournament]);
        $winners = TournamentForecasters::widget([
            'tournament' => $tournament,
            'items' => $forecastStandings->getWinners(),
            'mode' => TournamentForecasters::MODE_SIMPLE,
        ]);

        //create news first

        $category = $tournament->id;
        $subj = "Закончен турнир " . $tournament->tournament;
        $body = $this->createNewsBody($tournament, $standings, $winners);

        /** @var Newz $news */
        $news = $this->make(Newz::class);
        $news->tournament_id = $category;
        $news->subject = $subj;
        $news->body = $body;

        // todo put currently logged on user
        $news->user_id = User::ADMIN_ID;

        $this->make(ItemCreateService::class, [$news])->run();

        //send user notifications

        /** @var User[] $users */
        $users = $this->userQuery->tournamentNotificationsSubscribers($tournament->id)->all();
        $allForecasters = $forecastStandings->getStandings();

        if (!empty($users)) {

            //getting array of positions 'user_id' => 'position'
            $usersPositions = [];
            foreach ($users as $user) {
                $usersPositions[$user->id] = $forecastStandings->getPosition($user) + 1;
            }
            $mailService = MailFactory::makeTournamentFinishedMailerService($users, $tournament, $standings, $winners, $allForecasters, $usersPositions);

            if ($mailService->run() !== count($users))
                throw new Exception("Ошибка отправки нотификаций о завершении турнира ". $tournament->id);
        }
        //mark old news as archived
    }

    protected function createNewsBody(Tournament $tournament, $standings, $winners)
    {
        return Yii::$app->controller->renderPartial('/newsTemplates/tournamentFinished', ['tournament' => $tournament, 'standings' => $standings, 'winners' => $winners]);
    }
}