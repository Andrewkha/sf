<?php

namespace app\modules\admin\models;

use app\modules\admin\resources\behaviors\fileUploadBehavior;

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
    const TEAMS_LOGO_UPLOAD_PATH = 'images/logos';


    public function behaviors() {

        return [
            'fileUpload' =>
                [
                    'class' => fileUploadBehavior::className(),
                    'toAttribute' => 'logo',
                    'imagePath' => self::TEAMS_LOGO_UPLOAD_PATH,
                    'default' => 'nologo.jpeg',
                    'prefix' => 'time',
                ],
        ];
    }


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
