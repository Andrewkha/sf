<?php

namespace app\modules\admin\models\query;
use app\modules\admin\models\Tournament;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\Tournament]].
 *
 * @see \app\modules\admin\models\Tournament
 */
class TournamentQuery extends \yii\db\ActiveQuery
{
    public function notFinished()
    {
        return $this->andWhere(['or', ['status' => Tournament::STATUS_NOT_STARTED], ['status' => Tournament::STATUS_IN_PROGRESS]]);
    }

    public function notStarted()
    {
        return $this->where(['status' => Tournament::STATUS_NOT_STARTED]);
    }

    public function inProgress()
    {
        return $this->where(['status' => Tournament::STATUS_IN_PROGRESS]);
    }
}
