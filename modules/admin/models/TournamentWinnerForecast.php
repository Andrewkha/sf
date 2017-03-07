<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%tournament_winner_forecast}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tournament_id
 * @property integer $team_id
 * @property integer $position
 * @property integer $date
 *
 * @property Team $team
 * @property Tournament $tournament
 * @property User $user
 */
class TournamentWinnerForecast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tournament_winner_forecast}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tournament_id', 'team_id', 'position', 'date'], 'integer'],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
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
            'id' => 'ID',
            'user_id' => 'User ID',
            'tournament_id' => 'Tournament ID',
            'team_id' => 'Team ID',
            'position' => 'Position',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
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
     * @return \app\modules\admin\models\query\TournamentWinnerForecastQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\TournamentWinnerForecastQuery(get_called_class());
    }
}