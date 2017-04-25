<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/21/2017
 * Time: 11:57 AM
 */

namespace app\events;


use app\modules\admin\models\Tournament;
use app\modules\admin\services\ItemCreateService;
use app\traits\ContainerAwareTrait;
use app\modules\admin\models\Newz;
use app\modules\user\models\User;
use Yii;

class TournamentCreateHandler
{
    use ContainerAwareTrait;

    public function tournamentCreateHandle(Tournament $tournament)
    {
        $category = 0;
        $subj = "Добавлен новый турнир " . $tournament->tournament;
        $body = Yii::$app->controller->renderPartial('/newsTemplates/tournamentCreate', ['tournament' => $tournament]);

        /** @var Newz $news */
        $news = $this->make(Newz::class);
        $news->tournament_id = $category;
        $news->subject = $subj;
        $news->body = $body;

        // todo put currently logged on user
        $news->user_id = User::ADMIN_ID;
        $news->scenario = Newz::SCENARIO_SEND;

        $this->make(ItemCreateService::class, [$news])->run();

    }
}