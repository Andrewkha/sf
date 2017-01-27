<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 9:53 AM
 */

namespace app\modules\admin\repositories;


use app\modules\admin\models\Country;
use app\modules\admin\repositories\exceptions\NotFoundException;
use app\modules\admin\repositories\exceptions\TypeMismatchException;
use yii\db\ActiveRecord;

class CountryRepository implements RepositoryInterface
{

    /**
     * @param $id
     * @return Country
     * @throws NotFoundException
     */
    public function find($id) : Country
    {
        if (!$country = Country::findOne($id)) {
            throw new NotFoundException();
        }
        return $country;
    }

    /**
     * @param ActiveRecord $country
     * @param $validate boolean - whether to validate the model before save, false default
     * @throws \RuntimeException
     * @throws TypeMismatchException
     */
    public function save(ActiveRecord $country, $validate = false)
    {
        if(!($country instanceOf Country))
            throw new TypeMismatchException();

        if($country->save($validate) === false)
            throw new \RuntimeException('Ошибка сохранения записи');
    }

    /**
     * @param $country ActiveRecord
     * @throws \RuntimeException
     * @throws TypeMismatchException
     */
    public function delete(ActiveRecord $country)
    {
        if(!($country instanceOf Country))
            throw new TypeMismatchException();

        if($country->delete() === false)
            throw new \RuntimeException('Ошибка удаления записи');
    }

    public function getCountryClass()
    {
        return Country::className();
    }
}