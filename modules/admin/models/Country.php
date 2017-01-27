<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property integer $id
 * @property string $country
 *
 * @property Team[] $teams
 * @property Tournament[] $tournaments
 */
class Country extends \yii\db\ActiveRecord
{
    /*
     * @param string $name
     * @returns Country
     */
    public static function create($name)
    {
        $country = new self();
        $country->country = $name;
        return $country;
    }

    public function editData($name)
    {
        $this->country = $name;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Страна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['country_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['country'], 'required'],
            ['country', 'unique', 'message' => 'Такая страна уже есть'],
            [['country'], 'string', 'max' => 50],
        ];
    }
}
