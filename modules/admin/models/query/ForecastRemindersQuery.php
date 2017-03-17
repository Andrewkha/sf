<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\ForecastReminders]].
 *
 * @see \app\modules\admin\models\ForecastReminders
 */
class ForecastRemindersQuery extends \yii\db\ActiveQuery
{

    public function whereUserTournamentTour($user, $tournament, $tour)
    {
        return $this->where(['user_id' => $user])->andWhere(['tournament_id' => $tournament])->andWhere(['tour' => $tour]);
    }

}
