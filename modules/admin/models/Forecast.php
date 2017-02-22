<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%forecast}}".
 *
 * @property integer $user_id
 * @property integer $game_id
 * @property integer $fscoreHome
 * @property integer $fscoreGuest
 * @property integer|null $forecastPoints
 * @property integer $date
 *
 * @property Game $game
 * @property User $user
 */
class Forecast extends \yii\db\ActiveRecord
{
    protected $forecastPoints = NULL;

    public function getForecastPoints()
    {
        return $this->forecastPoints;
    }

    public function setForecastPoints($points)
    {
        $this->forecastPoints = $points;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forecast}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'game_id'], 'required'],
            [['user_id', 'game_id', 'fscoreHome', 'fscoreGuest', 'date'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'game_id' => 'Game ID',
            'fscoreHome' => 'Fscore Home',
            'fscoreGuest' => 'Fscore Guest',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\query\ForecastQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\ForecastQuery(get_called_class());
    }
}
