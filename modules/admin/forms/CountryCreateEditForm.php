<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 3:13 PM
 */

namespace app\modules\admin\forms;

use yii\base\Model;
use app\modules\admin\models\Country;

class CountryCreateEditForm extends Model
{
    public $country;

    public function rules()
    {
        return [
            [['country'], 'required', 'message' => 'Не может быть пустым'],
            [['country'], 'unique', 'targetClass' => Country::className(), 'targetAttribute' => 'country', 'message' => 'Такая страна уже есть'],
            [['country'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Страна',
        ];
    }
}