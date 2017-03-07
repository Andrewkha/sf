<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\TournamentWinnerForecast]].
 *
 * @see \app\modules\admin\models\TournamentWinnerForecast
 */
class TournamentWinnerForecastQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\TournamentWinnerForecast[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\TournamentWinnerForecast|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
