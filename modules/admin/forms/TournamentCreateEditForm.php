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
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Country;

class TournamentCreateEditForm extends Model
{
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

    /** @property $model Tournament|null  */
    private $model = null;

    public function __construct(Tournament $model = null, array $config = [])
    {
        if ($model !== null)
            $this->model = $model;
        parent::__construct($config);
    }

    public function init()
    {
        if($this->model !== null) {
            $this->tournament = $this->model->tournament;
            $this->country_id = $this->model->country_id;
            $this->logo = $this->model->logo;
            $this->type = $this->model->type;
            $this->tours = $this->model->tours;
            $this->status = $this->model->status;
            $this->starts = $this->model->starts;
            $this->autoprocess = $this->model->autoprocess;
            $this->autoprocessURL = $this->model->autoprocessURL;
            $this->winnersForecastDue = $this->model->winnersForecastDue;
        }
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tournament', 'country_id', 'status'], 'required'],
            [['country_id', 'type', 'tours', 'status', 'autoprocess'], 'integer'],
            [['starts'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'starts'],
            [['winnersForecastDue'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'winnersForecastDue'],
            [['tournament'], 'string', 'max' => 150],
            [['autoprocessURL'], 'string', 'max' => 255],
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