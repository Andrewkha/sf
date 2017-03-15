<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/7/2017
 * Time: 5:49 PM
 */

namespace app\modules\admin\helpers;

use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\Tournament;
use yii\helpers\ArrayHelper;

class TournamentHelper
{

    public static function getTypeList()
    {
        return [
            Tournament::TYPE_PLAYOFF => 'Плейофф',
            Tournament::TYPE_REGULAR => 'Круговой',
        ];
    }

    public static function getTypeFriendly($type)
    {
        return ArrayHelper::getValue(self::getTypeList(), $type);
    }

    public static function getStatusList()
    {
        return [
            Tournament::STATUS_NOT_STARTED => 'Не начался',
            Tournament::STATUS_IN_PROGRESS => 'Проходит',
            Tournament::STATUS_FINISHED => 'Закончен',
        ];
    }

    public static function getStatusFriendly($status)
    {
        return ArrayHelper::getValue(self::getStatusList(), $status);
    }

    public static function getNextTour(Tournament $tournament)
    {
        if ($tournament->isFinished())
            return null;

        /** @var GameQuery $gameQuery */
        $gameQuery = \Yii::createObject(GameQuery::class);
        $minTour = $gameQuery->where(['>', 'date', time()])->andWhere(['tournament_id' => $tournament->id])->min('tour');

        while ($minTour < $tournament->tours) {
            if ($minTour === $tournament->tours)
                return null;
            $games = $gameQuery->whereTourInTournament($tournament->id, $minTour)->finishedGames()->all();
            if(count($games) > 0)
                $minTour++;
            else
                return $minTour;
        }
    }
}