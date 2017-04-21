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

class TournamentCreateHandler
{
    use ContainerAwareTrait;

    public function tournamentCreateHandle(Tournament $tournament)
    {
        $category = 0;
        $subj = "Добавлен новый турнир " . $tournament->tournament;
        $body = "<p>Для прогноза доступен новый турнир {$tournament->tournament}, первый тур которого состоится " . date('d.m.y', $tournament->starts) ." </p>"
                . "<p>Вы также можете попробовать угадать призеров турнира и заработать дополнительные очки! Прогноз на призеров принимается до " . date('d.m.y', $tournament->winnersForecastDue) . "</p>"
                . "<p>Спешите принять участие! Зайдите в <strong>Профиль->Мои турниры</strong> чтобы начать делать прогнозы</p>";

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