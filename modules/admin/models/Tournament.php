<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%tournament}}".
 *
 * @property integer $id
 * @property string $tournament
 * @property integer $country_id
 * @property string $logo
 * @property integer $type
 * @property integer $tours
 * @property integer $status
 * @property integer $starts
 * @property integer $autoprocess
 * @property string $autoprocessURL
 * @property integer $winnersForecastDue
 *
 * @property ForecastReminders[] $forecastReminders
 * @property Game[] $games
 * @property TeamTournament[] $teamTournaments
 * @property Team[] $teams
 * @property Country $country
 * @property TournamentWinnerForecast[] $tournamentWinnerForecasts
 * @property Tourresultnotification[] $tourresultnotifications
 * @property UserTournament[] $userTournaments
 * @property User[] $users
 */
class Tournament extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tournament}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tournament', 'country_id'], 'required'],
            [['country_id', 'type', 'tours', 'status', 'starts', 'autoprocess', 'winnersForecastDue'], 'integer'],
            [['tournament'], 'string', 'max' => 150],
            [['logo', 'autoprocessURL'], 'string', 'max' => 255],
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
            'tournament' => 'Tournament',
            'country_id' => 'Country ID',
            'logo' => 'Logo',
            'type' => 'Type',
            'tours' => 'Tours',
            'status' => 'Status',
            'starts' => 'Starts',
            'autoprocess' => 'Autoprocess',
            'autoprocessURL' => 'Autoprocess Url',
            'winnersForecastDue' => 'Winners Forecast Due',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForecastReminders()
    {
        return $this->hasMany(ForecastReminders::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamTournaments()
    {
        return $this->hasMany(TeamTournament::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasMany(Team::className(), ['id' => 'team_id'])->viaTable('{{%team_tournament}}', ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournamentWinnerForecasts()
    {
        return $this->hasMany(TournamentWinnerForecast::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourresultnotifications()
    {
        return $this->hasMany(Tourresultnotification::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTournaments()
    {
        return $this->hasMany(UserTournament::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_tournament}}', ['tournament_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\query\TournamentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\TournamentQuery(get_called_class());
    }
}
