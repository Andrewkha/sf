<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%team}}".
 *
 * @property integer $id
 * @property string $team
 * @property integer $country_id
 * @property string $logo
 *
 * @property Game[] $games
 * @property Game[] $games0
 * @property Country $country
 * @property TeamTournament[] $teamTournaments
 * @property Tournament[] $tournaments
 * @property TournamentWinnerForecast[] $tournamentWinnerForecasts
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%team}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['team'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 255],
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
            'team' => 'Team',
            'country_id' => 'Country ID',
            'logo' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['teamGuest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames0()
    {
        return $this->hasMany(Game::className(), ['teamHome_id' => 'id']);
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
    public function getTeamTournaments()
    {
        return $this->hasMany(TeamTournament::className(), ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['id' => 'tournament_id'])->viaTable('{{%team_tournament}}', ['team_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournamentWinnerForecasts()
    {
        return $this->hasMany(TournamentWinnerForecast::className(), ['team_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\query\TeamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\TeamQuery(get_called_class());
    }
}
