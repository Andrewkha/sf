<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 9:44 AM
 */

namespace app\modules\admin\repositories;

use yii\db\ActiveRecord;

interface RepositoryInterface
{

    public function find($id);

    public function save(ActiveRecord $model, $validate);

    public function delete(ActiveRecord $model);

    public function getClass();
}