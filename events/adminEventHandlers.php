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

Event::on(Tournament::class, ItemEvent::EVENT_AFTER_CREATE, function (ItemEvent $e) {
    //todo implement user notification after tournament is created
});

Event::on(Tournament::class, TournamentEvent::EVENT_TOURNAMENT_FINISHED, function (TournamentEvent $e) {
    //todo implement user notification after tournament is finished
});