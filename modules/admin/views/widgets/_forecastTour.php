<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/7/2017
 * Time: 12:45 PM
 */
use yii\bootstrap\Modal;
use app\resources\dto\Tour;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $tour integer */
/* @var $games \yii\data\ArrayDataProvider */
/* @var $forecast \app\resources\dto\Tour */
/* @var $user \app\models\User */
?>

<?php Modal::begin([
    'header' => "<h4>$user->username - $tour тур</h4>",
    'toggleButton' => [
        'label' => $tour,
        'class' => (is_null($forecast)) ? 'btn btn-danger' : (($forecast->tourForecastStatus === Tour::TOUR_FORECAST_COMPLETE) ? 'btn btn-success' : 'btn btn-warning'),
        'style' => 'margin-bottom: 5px'
    ],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_DEFAULT,
]);
?>
<?= GridView::widget([
    'dataProvider' => $games,
    'summary' => false,
    'condensed' => true,
    'columns' => [
        [
            'attribute' => 'date',
            'headerOptions' => [
                'class' => 'kv-align-center',
            ],
            'value' => function ($model) {
                return date('d.m.Y H:i', $model->date);
            }
        ],

        [
            'attribute' => 'teamHome.team',
            'headerOptions' => [
                'class' => 'kv-align-center',
            ],
        ],

        [
            'value' => function ($model) use ($forecast) {
                $forecastString = (is_null($forecast) || !key_exists($model->id, $forecast->tourGames)) ? ' - : - ' : ' ' . $forecast->tourGames[$model->id]->forecastHome . ' : ' . $forecast->tourGames[$model->id]->forecastGuest;
                return $forecastString;
            }
        ],

        [
            'attribute' => 'teamGuest.team',
            'headerOptions' => [
                'class' => 'kv-align-center',
            ],
        ],
    ]
]);?>
<?php Modal::end() ?>

