<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 2:54 PM
 */

namespace app\modules\admin\forms;


use app\modules\admin\models\Newz;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\modules\user\models\User;

class NewzCreateEditForm extends Model
{
    public $subject;
    public $body;
    public $user_id;
    public $tournament_id;
    public $isSend;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'body', 'tournament_id'], 'required'],
            [['body'], 'string'],
            [['user_id', 'tournament_id'], 'integer'],
            ['isSend', 'safe'],
            [['subject'], 'string', 'max' => 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Заголовок',
            'body' => 'Содержание',
            'tournament_id' => 'Категория',
            'isSend' => 'Отправить пользователям'
        ];
    }
    public static function getCategories()
    {
        return ['0' => 'Новости сайта'] +
            ArrayHelper::map(Newz::find()
                ->where(['not', ['tournament_id' => 0]])
                ->with('tournament')
                ->orderBy(['tournament_id' => SORT_DESC])
                ->distinct()
                ->all(),
            'tournament_id', 'tournament.tournament');
    }

    public static function getAuthors()
    {
        return ArrayHelper::map(Newz::find()->with('user')->distinct('user_id')->all(), 'user_id', 'user.username');
    }

    public static function getStatuses()
    {
        return [Newz::STATUS_ACTIVE => 'Актив', Newz::STATUS_ARCHIVED => 'Архив'];
    }

}