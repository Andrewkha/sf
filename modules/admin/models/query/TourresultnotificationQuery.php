<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\Tourresultnotification]].
 *
 * @see \app\modules\admin\models\Tourresultnotification
 */
class TourresultnotificationQuery extends \yii\db\ActiveQuery
{

    public function ifNotified($tournament, $tour)
    {
        return ($this->where(['tournament_id' => $tournament, 'tour' => $tour])->exists());
    }
}
