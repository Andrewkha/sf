<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\TeamTournament]].
 *
 * @see \app\modules\admin\models\TeamTournament
 */
class TeamTournamentQuery extends \yii\db\ActiveQuery
{

    public function tournamentParticipants($tournament)
    {
        return $this->andWhere(['tournament_id' => $tournament]);
    }

}
