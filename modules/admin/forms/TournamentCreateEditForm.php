<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/8/2017
 * Time: 5:55 PM
 */

namespace app\modules\admin\forms;

use yii\base\Model;
use app\modules\admin\models\Tournament;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Country;
use app\modules\admin\resources\behaviors\fileUploadBehavior;

class TournamentCreateEditForm extends Model
{
    public $id;
    public $tournament;
    public $country_id;
    public $logo;
    public $type;
    public $tours;
    public $status;
    public $starts;
    public $autoprocess;
    public $autoprocessURL;
    public $winnersForecastDue;

    const TRN_LOGO_UPLOAD_PATH = 'images/trn_logos';

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

    /* @param $model Tournament */

    public function assignProperties(Tournament $model)
    {
        $this->id = $model->id;
        $this->tournament = $model->tournament;
        $this->country_id = $model->country_id;
        $this->logo = $model->logo;
        $this->type = $model->type;
        $this->tours = $model->tours;
        $this->status = $model->status;
        $this->starts = date('d.m.Y', $model->starts);
        $this->winnersForecastDue = date('d.m.Y', $model->winnersForecastDue);
        $this->autoprocess = $model->autoprocess;
        $this->autoprocessURL = $model->autoprocessURL;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tournament', 'country_id', 'status'], 'required'],
            [['country_id', 'type', 'tours', 'status', 'autoprocess', 'id'], 'integer'],
            [
                'tournament',
                'unique',
                'targetClass' => Tournament::className(),
                'targetAttribute' => 'tournament',
                'message' => 'Такой турнир уже есть',
                'filter' => function(Query $query) {
                    return isset($this->id)? $query->andWhere(['not', ['id' => $this->id]]) : $query;
                }
            ],
            [['starts'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'starts'],
            [['winnersForecastDue'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'winnersForecastDue'],
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
            'starts' => 'Начало',
            'autoprocess' => 'Автопроцессинг',
            'autoprocessURL' => 'Страница автопроцессинга',
            'winnersForecastDue' => 'Окончание приема прогноза на победителей',
        ];
    }
    public static function getCountriesArray()
    {
        return ArrayHelper::map(Country::find()->orderBy(['country' => SORT_ASC])->asArray()->all(), 'id', 'country');
    }
}