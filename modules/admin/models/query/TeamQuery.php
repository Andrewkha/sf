<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\Team]].
 *
 * @see \app\modules\admin\models\Team
 */
class TeamQuery extends \yii\db\ActiveQuery
{
    public function whereCountry($country)
    {
        return $this->andWhere(['country_id' => $country]);
    }
}
