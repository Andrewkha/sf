<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\Team]].
 *
 * @see \app\modules\admin\models\Team
 */
class TeamQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return \app\modules\admin\models\Team[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\Team|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function whereCountry($country)
    {
        return $this->andWhere(['country_id' => $country]);
    }
}
