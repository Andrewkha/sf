<?php

namespace app\modules\user\models;

use Yii;
use app\modules\admin\models\Forecast;
use app\modules\admin\models\Tournament;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $firstName
 * @property string $lastName
 * @property string $avatar
 * @property string $forgottenPasswordCode
 * @property string $activationString
 * @property string $auth_key
 * @property integer $userStatus
 * @property integer $notificationsStatus
 * @property integer $created_on
 * @property integer $updated_on
 * @property integer $lastLogin
 *
 * @property Forecast[] $forecasts
 * @property ForecastReminders[] $forecastReminders
 * @property Newz[] $newzs
 * @property TournamentWinnerForecast[] $tournamentWinnerForecasts
 * @property UserTournament[] $userTournaments
 * @property Tournament[] $tournaments
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userStatus', 'notificationsStatus', 'created_on', 'updated_on', 'lastLogin'], 'integer'],
            [['username', 'password', 'email', 'avatar', 'forgottenPasswordCode', 'activationString'], 'string', 'max' => 255],
            [['firstName', 'lastName'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Password',
            'email' => 'Email',
            'firstName' => 'Имя',
            'lastName' => 'Фамилия',
            'avatar' => 'Аватар',
            'forgottenPasswordCode' => 'Секретный код восстановления пароля',
            'activationString' => 'Строка активации',
            'auth_key' => 'Auth Key',
            'userStatus' => 'Статус',
            'notificationsStatus' => 'Нотификации',
            'created_on' => 'Создан',
            'updated_on' => 'Изменен',
            'lastLogin' => 'Последний вход',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForecasts()
    {
        return $this->hasMany(Forecast::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForecastReminders()
    {
        return $this->hasMany(ForecastReminders::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewzs()
    {
        return $this->hasMany(Newz::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournamentWinnerForecasts()
    {
        return $this->hasMany(TournamentWinnerForecast::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTournaments()
    {
        return $this->hasMany(UserTournament::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['id' => 'tournament_id'])->viaTable('{{%user_tournament}}', ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\user\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\user\models\query\UserQuery(get_called_class());
    }
}
