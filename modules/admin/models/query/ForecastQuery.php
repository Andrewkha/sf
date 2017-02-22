<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\Forecast]].
 *
 * @see \app\modules\admin\models\Forecast
 */
class ForecastQuery extends \yii\db\ActiveQuery
{
    public function whereGame($game_id)
    {
        return $this->andWhere(['game_id' => $game_id]);
    }

    public function whereUser($user_id)
    {
        return $this->andWhere(['user_id' => $user_id]);
    }
}
