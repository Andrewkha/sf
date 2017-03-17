<?php

namespace app\modules\user\models\query;
use app\modules\admin\models\UserTournament;

/**
 * This is the ActiveQuery class for [[\app\modules\user\models\User]].
 *
 * @see \app\modules\user\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{

    public function tournamentNotificationsSubscribers($tournament)
    {
        return $this->joinWith('userTournaments', false)->where(['tournament_id' => $tournament, 'notification' => UserTournament::NOTIFICATION_ENABLED]);
    }
}
