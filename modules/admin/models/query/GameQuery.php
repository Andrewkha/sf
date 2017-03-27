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
        return $this->where(['tournament_id' => $tournament, 'tour' => $tour]);
    }

    public function whereParticipants($teamHome, $teamGuest)
    {
        return $this->andWhere(['teamHome_id' => $teamHome, 'teamGuest_id' => $teamGuest]);
    }

    public function whereTournament($tournament)
    {
        return $this->where(['tournament_id' => $tournament]);
    }

    public function finishedGamesWithTeams()
    {
        return $this->finishedGames()->with(['teamHome', 'teamGuest']);
    }

    public function finishedGames()
    {
        return $this->andWhere(['not', ['scoreHome' => null]])->andWhere(['not', ['scoreGuest' => null]]);
    }

    public function firstGameInTourDate($tournament, $tour)
    {
        return $this->whereTourInTournament($tournament, $tour)->min('date');
    }

    public function isTourFinished($tournament, $tour)
    {
        $count = $this->where(['scoreHome' => null, 'scoreGuest' => null])->andWhere(['tournament_id' => $tournament])->andWhere(['tour' => $tour]);
        return $count->count() == 0;
    }
}
