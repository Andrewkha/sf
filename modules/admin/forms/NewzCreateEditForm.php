<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 2:54 PM
 */

namespace app\modules\admin\forms;


use app\modules\admin\models\Newz;
use app\modules\user\models\User;
use yii\helpers\ArrayHelper;

class NewzCreateEditForm
{

    public static function getCategories()
    {
        return ['0' => 'Новости сайта'] +
            ArrayHelper::map(Newz::find()
                ->where(['not', ['tournament_id' => 0]])
                ->with('tournament')
                ->orderBy(['tournament_id' => SORT_DESC])
                ->distinct()
                ->all(),
            'tournament_id', 'tournament.tournament');
    }

    public static function getAuthors()
    {
        return ArrayHelper::map(Newz::find()->with('user')->distinct('user_id')->all(), 'user_id', 'user.username');
    }

}