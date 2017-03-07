<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\UserTournament]].
 *
 * @see \app\modules\admin\models\UserTournament
 */
class UserTournamentQuery extends \yii\db\ActiveQuery
{

    public function whereTournament($tournament)
    {
        return $this->andWhere(['tournament_id' => $tournament]);
    }
}
