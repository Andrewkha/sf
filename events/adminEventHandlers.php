<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 10:11 AM
 */

use yii\base\Event;
use app\modules\admin\models\Tournament;
use app\modules\admin\events\ItemEvent;
use app\modules\admin\events\TournamentEvent;
use app\modules\admin\events\TourEvent;
use app\modules\admin\models\Newz;
use app\events\TournamentCreateHandler;
use yii\log\Logger;


Event::on(Tournament::class, ItemEvent::EVENT_AFTER_CREATE, function (ItemEvent $e) {
    //todo implement user notification after tournament is created

    /** @var Tournament $tournament */
    $tournament = $e->getModel();
    (new TournamentCreateHandler)->tournamentCreateHandle($tournament);

});

Event::on(Tournament::class, TournamentEvent::EVENT_TOURNAMENT_FINISHED, function (TournamentEvent $e) {
    //todo implement user notification after tournament is finished

    $tournament = $e->getTournament();
    try {
        (Yii::createObject(\app\events\TournamentFinishedHandler::class))->tournamentFinishedHandle($tournament);
    } catch (Exception $exception) {

        /** @var Logger $logger */
        $logger = Yii::getLogger();
        $logger->log($exception->getMessage(), Logger::LEVEL_ERROR);
    }
});

Event::on (Tournament::class, TourEvent::EVENT_TOUR_FINISHED, function (TourEvent $event) {

});

Event::on(Newz::class, ItemEvent::EVENT_AFTER_CREATE, function (ItemEvent $e) {

    /** @var Newz $news */
    $news = $e->getModel();
    if ($news->scenario === Newz::SCENARIO_SEND)
    {
        try {
            (new \app\events\NewsSendHandler())->newsSendHandle($news);
        } catch (Exception $exception) {

            /** @var Logger $logger */
            $logger = Yii::createObject(Logger::class);
            $logger->log($exception->getMessage(), Logger::LEVEL_ERROR);
        }
    }
});