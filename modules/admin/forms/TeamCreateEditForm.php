<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 3:37 PM
 */

namespace app\modules\admin\forms;

use yii\base\Model;
use app\modules\admin\models\Country;
use yii\helpers\ArrayHelper;

class TeamCreateEditForm extends Model
{
    public $team;
    public $country_id;
    public $logo;

    public function rules()
    {
        return [
            [['team', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['team'], 'string', 'max' => 50],
            [['logo'], 'image', 'maxSize' => 1024*1024, 'tooBig' => 'Максимальный размер файла 1Мб',],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team' => 'Название',
            'country_id' => 'Страна',
            'logo' => 'Логотип',
        ];
    }

    public static function getCountriesArray()
    {
        return ArrayHelper::map(Country::find()->orderBy(['country' => SORT_ASC])->asArray()->all(), 'id', 'country');
    }
}