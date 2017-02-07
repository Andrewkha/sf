<?php

namespace app\modules\admin\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\admin\models\Tournament]].
 *
 * @see \app\modules\admin\models\Tournament
 */
class TournamentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\Tournament[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\Tournament|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
