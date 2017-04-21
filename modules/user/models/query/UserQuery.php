<?php

namespace app\modules\user\models\query;

use app\modules\admin\models\UserTournament;
use app\modules\user\models\User;

/**
 * This is the ActiveQuery class for [[\app\modules\user\models\User]].
 *
 * @see \app\modules\user\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{

    public function tournamentNotificationsSubscribers($tournament)
    {
        return $this->where(['userStatus' => User::STATUS_ACTIVE])
            ->joinWith('userTournaments', false)
            ->andWhere(['tournament_id' => $tournament, 'notification' => UserTournament::NOTIFICATION_ENABLED]);
    }

    public function siteNewsSubscribers()
    {
        return $this->where(['userStatus' => User::STATUS_ACTIVE])
            ->andWhere(['notificationsStatus' => User::NOTIFICATIONS_ENABLED]);
    }
}
