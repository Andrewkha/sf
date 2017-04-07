<?php

namespace app\modules\admin\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%newz}}".
 *
 * @property integer $id
 * @property string $subject
 * @property string $body
 * @property integer $user_id
 * @property integer $tournament_id
 * @property integer $date
 * @property integer $status
 *
 * @property User $user
 * @property Tournament $tournament
 */
class Newz extends \yii\db\ActiveRecord
{
    const SCENARIO_SEND = 'send';

    const SITE_NEWZ = 'Новости сайта';

    const STATUS_ARCHIVED = 1;
    const STATUS_ACTIVE = 0;

    private $isSend;
    /**
     * @var string - tournament name if for specific tournament, general site newz otherwise
     */
    protected $newzCategory;

    public function __construct(array $config = [])
    {
        $this->status = self::STATUS_ACTIVE;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%newz}}';
    }

    public function behaviors()
    {
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
    public function rules()
    {
        return [
            [['subject', 'body', 'user_id', 'tournament_id'], 'required', 'on' => ['default', self::SCENARIO_SEND]],
            ['newzCategory', 'safe'],
            [['body'], 'string'],
            [['user_id', 'tournament_id', 'date', 'status'], 'integer'],
            [['subject'], 'string', 'max' => 1024],
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
            'subject' => 'Тема',
            'body' => 'Содержание',
            'user_id' => 'Автор',
            'tournament_id' => 'Категория',
            'date' => 'Дата',
            'status' => 'Статус',
            'newzCategory' => 'Категория'
        ];
    }

    public function setIsSend($value)
    {
        if ($value == 1)
            $this->scenario = self::SCENARIO_SEND;
    }

    public function isArchived()
    {
        return ($this->status === self::STATUS_ARCHIVED);
    }

    public function isActive()
    {
        return ($this->status === self::STATUS_ACTIVE);
    }

    public function toArchive()
    {
        $this->status = self::STATUS_ARCHIVED;
        if ($this->save())
            return true;
        else
            return false;
    }

    public function toActive()
    {
        $this->status = self::STATUS_ACTIVE;
        if ($this->save())
            return true;
        else
            return false;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getNewzCategory()
    {
        if ($this->tournament_id === 0)
            return self::SITE_NEWZ;
        else
            return $this->tournament->tournament;
    }

    public function getTournament()
    {
        return $this->hasOne(Tournament::className(), ['id' => 'tournament_id']);
    }

    /**
     * @inheritdoc
     * @return \app\modules\admin\models\query\NewzQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\modules\admin\models\query\NewzQuery(get_called_class());
    }
}
