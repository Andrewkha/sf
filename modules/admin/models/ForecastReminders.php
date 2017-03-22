<?php

namespace app\modules\admin\models;

use app\modules\user\models\User;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%forecast_reminders}}".
 *
 * @property integer $user_id
 * @property integer $tournament_id
 * @property integer $tour
 * @property integer $reminders
 * @property integer $date
 *
 * @property Tournament $tournament
 * @property User $user
 */
class ForecastReminders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forecast_reminders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tournament_id', 'tour'], 'required'],
            [['user_id', 'tournament_id', 'tour', 'date'], 'integer'],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournament::className(), 'targetAttribute' => ['tournament_id' => 'id']],
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
            'tournament_id' => 'Tournament ID',
            'tour' => 'Tour',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournament()
    {
        return $this->hasOne(Tournament::className(), ['id' => 'tournament_id']);
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
     * @return \app\modules\admin\models\query\ForecastRemindersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\ForecastRemindersQuery(get_called_class());
    }
}
