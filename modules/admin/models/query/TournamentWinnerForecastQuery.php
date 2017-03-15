<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\TournamentWinnerForecast]].
 *
 * @see \app\modules\admin\models\TournamentWinnerForecast
 */
class TournamentWinnerForecastQuery extends \yii\db\ActiveQuery
{
    public function whereUserTournament($user, $tournament) {
        return $this->where(['user_id' => $user])
            ->andWhere(['tournament_id' => $tournament])
            ->with('team')
            ->orderBy(['position' => SORT_ASC])
            ->indexBy('position');
    }
}
