<?php

namespace app\modules\admin\models;

use phpDocumentor\Reflection\Types\Null_;
use Yii;

/**
 * This is the model class for table "{{%game}}".
 *
 * @property integer $id
 * @property integer $tournament_id
 * @property integer $teamHome_id
 * @property integer $teamGuest_id
 * @property integer $tour
 * @property integer $date
 * @property integer $scoreHome
 * @property integer $scoreGuest
 * @property integer $pointsHome
 * @property integer $pointsGuest
 *
 * @property Forecast[] $forecasts
 * @property User[] $users
 * @property Team $teamGuest
 * @property Team $teamHome
 * @property Tournament $tournament
 */
class Game extends \yii\db\ActiveRecord
{
    protected $pointsHome = NULL;
    protected $pointsGuest = NULL;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%game}}';
    }

    /**
     * @return int
     */
    public function getPointsGuest()
    {
        return $this->pointsGuest;
    }

    /**
     * @param int $pointsGuest
     */
    public function setPointsGuest(int $pointsGuest)
    {
        $this->pointsGuest = $pointsGuest;
    }

    /**
     * @return int
     */
    public function getPointsHome()
    {
        return $this->pointsHome;
    }

    /**
     * @param null $pointsHome
     */
    public function setPointsHome($pointsHome)
    {
        $this->pointsHome = $pointsHome;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tournament_id', 'teamHome_id', 'teamGuest_id', 'tour', 'date', 'scoreHome', 'scoreGuest'], 'integer'],
            [['teamHome_id', 'teamGuest_id', 'tour'], 'required'],
            [['teamGuest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['teamGuest_id' => 'id']],
            [['teamHome_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['teamHome_id' => 'id']],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournament::className(), 'targetAttribute' => ['tournament_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tournament_id' => 'Турнир',
            'teamHome_id' => 'Хозяева',
            'teamGuest_id' => 'Гости',
            'tour' => 'Тур',
            'date' => 'Дата',
            'scoreHome' => 'Счет хозяев',
            'scoreGuest' => 'Счет гостей',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForecasts()
    {
        return $this->hasMany(Forecast::className(), ['game_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%forecast}}', ['game_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamGuest()
    {
        return $this->hasOne(Team::className(), ['id' => 'teamGuest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamHome()
    {
        return $this->hasOne(Team::className(), ['id' => 'teamHome_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournament()
    {
        return $this->hasOne(Tournament::className(), ['id' => 'tournament_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\query\GameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\GameQuery(get_called_class());
    }
}
