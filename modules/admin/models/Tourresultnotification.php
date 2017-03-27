<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%tourresultnotification}}".
 *
 * @property integer $tournament_id
 * @property integer $tour
 * @property integer $date
 *
 * @property Tournament $tournament
 */
class Tourresultnotification extends \yii\db\ActiveRecord
{
    public function behaviors() {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => 'date',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tourresultnotification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tournament_id', 'tour'], 'required'],
            [['tournament_id', 'tour', 'date'], 'integer'],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournament::className(), 'targetAttribute' => ['tournament_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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
     * @inheritdoc
     * @return \app\modules\admin\models\query\TourresultnotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\TourresultnotificationQuery(get_called_class());
    }
}
