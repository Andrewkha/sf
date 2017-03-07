<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%user_tournament}}".
 *
 * @property integer $user_id
 * @property integer $tournament_id
 * @property integer $notification
 *
 * @property Tournament $tournament
 * @property User $user
 */
class UserTournament extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_tournament}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tournament_id'], 'required'],
            [['user_id', 'tournament_id', 'notification'], 'integer'],
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
            'notification' => 'Notification',
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
     * @return \app\modules\admin\models\query\UserTournamentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\UserTournamentQuery(get_called_class());
    }
}
