<?php

namespace app\modules\admin\models;

use app\modules\admin\events\TournamentEvent;
use app\modules\admin\resources\behaviors\fileUploadBehavior;
use app\modules\user\models\User;
use app\traits\ContainerAwareTrait;


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
    use ContainerAwareTrait;

    const TYPE_REGULAR = 1;
    const TYPE_PLAYOFF = 0;

    const STATUS_NOT_STARTED = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_FINISHED = 2;

    const AUTOPROCESS_ENABLED = 1;
    const AUTOPROCESS_DISABLED = 0;

    const TRN_LOGO_UPLOAD_PATH = 'images/trn_logos';

    /** @return  bool*/

    public function isFinished()
    {
        return $this->status == self::STATUS_FINISHED;
    }

    public function isNotStarted()
    {
        return $this->status == self::STATUS_NOT_STARTED;
    }

    public function isRegular()
    {
        return $this->type == self::TYPE_REGULAR;
    }

    public function isPlayoff()
    {
        return $this->type == self::TYPE_PLAYOFF;
    }

    public function isAutoProcess()
    {
        return ($this->autoprocess == self::AUTOPROCESS_ENABLED && !$this->isFinished());
    }

    public function isWinnersForecastOpen()
    {
        return (time() < $this->winnersForecastDue);
    }

    public function isSetToFinished()
    {
        return ($this->getOldAttribute('status') !== self::STATUS_FINISHED && $this->isFinished());
    }

    public function setToFinished()
    {
        $this->status = self::STATUS_FINISHED;
        $this->trigger(TournamentEvent::EVENT_TOURNAMENT_FINISHED, $this->make(TournamentEvent::class, [$this]));
        $this->save();
    }

    public function isLastTour($tour)
    {
        return ($tour === $this->tours);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tournament}}';
    }

    public function behaviors() {

        return [
            'fileUpload' =>
                [
                    'class' => fileUploadBehavior::className(),
                    'toAttribute' => 'logo',
                    'imagePath' => self::TRN_LOGO_UPLOAD_PATH,
                    'default' => 'nologo.jpeg',
                    'prefix' => 'time',
                ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tournament', 'country_id', 'status'], 'required'],
            [['country_id', 'type', 'tours', 'status', 'autoprocess', 'starts', 'winnersForecastDue'], 'integer'],
            ['tournament', 'unique', 'message' => 'Такой турнир уже есть'],
            [['tournament'], 'string', 'max' => 150],
            [['autoprocessURL'], 'url'],
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
            'tournament' => 'Турнир',
            'country_id' => 'Страна',
            'logo' => 'Логотип турнира',
            'type' => 'Тип',
            'tours' => 'Количество туров',
            'status' => 'Статус',
            'startsDate' => 'Начало турнира',
            'autoprocess' => 'Автопроцессинг',
            'autoprocessURL' => 'Источник данных',
            'wFDueDate' => 'Окончание приема прогноза на победителей',
        ];
    }

    public function getFirstGameDate()
    {
        return $this->getGames()->min('date');
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
