<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%team_tournament}}".
 *
 * @property integer $team_id
 * @property integer $tournament_id
 * @property string $alias
 *
 * @property Team $team
 * @property Tournament $tournament
 */
class TeamTournament extends \yii\db\ActiveRecord
{
    const SCENARIO_ALIAS_ASSIGN = 'aliasAssign';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%team_tournament}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['team_id', 'tournament_id'], 'required'],
            [['team_id', 'tournament_id'], 'integer'],
            [['alias'], 'string', 'max' => 255],
            ['alias', 'required', 'on' => self::SCENARIO_ALIAS_ASSIGN],
            ['team_id', 'unique', 'targetAttribute' => ['team_id', 'tournament_id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournament::className(), 'targetAttribute' => ['tournament_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'team_id' => 'Команда',
            'tournament_id' => 'Турнир',
            'alias' => 'Псевдоним',
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
     * @inheritdoc
     * @return \app\modules\admin\models\query\TeamTournamentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\TeamTournamentQuery(get_called_class());
    }
}
