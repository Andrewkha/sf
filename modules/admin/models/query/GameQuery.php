<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[Game]].
 *
 * @see Game
 */
class GameQuery extends \yii\db\ActiveQuery
{

    public function whereTourInTournament($tournament, $tour)
    {
        return $this->andWhere(['tournament_id' => $tournament, 'tour' => $tour]);
    }

    public function whereParticipants($teamHome, $teamGuest)
    {
        return $this->andWhere(['teamHome_id' => $teamHome, 'teamGuest_id' => $teamGuest]);
    }

    public function whereTournament($tournament)
    {
        return $this->andWhere(['tournament_id' => $tournament]);
    }

    public function finishedGames()
    {
        return $this->with(['teamHome', 'teamGuest'])->andWhere(['not', ['scoreHome' => null]])->andWhere(['not', ['scoreGuest' => null]]);
    }
}
