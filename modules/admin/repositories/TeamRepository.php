<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/31/2017
 * Time: 1:11 PM
 */

namespace app\modules\admin\repositories;

use app\modules\admin\models\Team;
use app\modules\admin\repositories\exceptions\NotFoundException;
use app\modules\admin\repositories\exceptions\TypeMismatchException;
use yii\db\ActiveRecord;

class TeamRepository implements RepositoryInterface
{
    /**
     * @param $id
     * @return Team
     * @throws NotFoundException
     */
    public function find($id) : Team
    {
        if (!$team = Team::findOne($id)) {
            throw new NotFoundException();
        }
        return $team;
    }

    /**
     * @param ActiveRecord $team
     * @param $validate boolean - whether to validate the model before save
     * @throws \RuntimeException
     * @throws TypeMismatchException
     */
    public function save(ActiveRecord $team, $validate)
    {
        if(!($team instanceOf Team))
            throw new TypeMismatchException();

        if($team->save($validate) === false)
            throw new \RuntimeException('Ошибка сохранения записи');
    }

    /**
     * @param $team ActiveRecord
     * @throws \RuntimeException
     * @throws TypeMismatchException
     */
    public function delete(ActiveRecord $team)
    {
        if(!($team instanceOf Team))
            throw new TypeMismatchException();

        if($team->delete() === false)
            throw new \RuntimeException('Ошибка удаления записи');
    }

    public function all()
    {
        return Team::find()->all();
    }

    public function getClass()
    {
        return Team::className();
    }
}