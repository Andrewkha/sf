<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 17.03.2017
 * Time: 16:34
 */

use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $games yii\data\ArrayDataProvider */
/* @var $tournament \app\modules\admin\models\Tournament */
/* @var $user \app\models\User */
/* @var $firstGame int */
/* @var $tour int */
/* @var $message yii\swiftmailer\Message */

?>
<div class="row">
    <table width="100%" align="center">
        <tr bgcolor="#8a8a8a">
            <td style = "padding:10px">
                <table align="center" width="40%">
                    <tr >
                        <td>
                            <?= Html::img($message->embed($logo), ['width' => 70]);?>
                        </td>
                        <td align="right">
                            <h4>Сайт Спортивных Прогнозов</h4>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table align="center" width="40%">
        <tr>
            <td style="font-size:16px: line-height:16px;" height="16px"></td>
        </tr>

        <tr>
            <td>
                <h2 style="font-size: 20px;"><?=$user->username?>,</h2>
                <p class="lead" style="font-size: 16px;">Вы сделали прогноз не на все матчи <?= $tour;?> тура турнира <?= $tournament->tournament?>.
                    Поторопитесь, первая игра тура начинается <?= date('d.m.Y', $firstGame);?> в <?= date('H:i', $firstGame)?> <br>
                    Прием прогноза на матч заканчивается за <?= Yii::$app->params['forecastEndTime']/60?> минут до его начала</p>
                <p>Удачи в прогнозах!</p>
            </td>
        </tr>
        <tr>
            <td>
                <h3 align="center"><?= Html::a('Сделать прогноз!', Url::to('/', true))?></h3>
            </td>
        </tr>
        <tr>
            <td>
                <?= GridView::widget([
                    'dataProvider' => $games,
                    'export' => false,
                    'toolbar' => '',
                    'summary' => false,
                    'condensed' => true,
                    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                    'rowOptions' => function ($model) use ($user) {
                        return (key_exists($model->id, $user->forecasts)) ? ['class' => 'success'] : ['class' => 'danger'];
                    },
                    'panel'=>[
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => $tour . " тур " . $tournament->tournament,
                    ],
                    'columns' => [
                        [
                            'attribute' => 'date',
                            'headerOptions' => [
                                'class' => 'kv-align-center',
                            ],
                            'value' => function ($model) {
                                return date('d.m.Y H:i', $model->date);
                            },
                            'enableSorting' => false,
                            'vAlign' => 'middle',
                            'hAlign' => 'center'
                        ],

                        [
                            'attribute' => 'teamHome.team',
                            'header' => 'Хозяева',
                            'headerOptions' => [
                                'class' => 'kv-align-center',
                            ],
                            'vAlign' => 'middle',
                            'hAlign' => 'right'
                        ],

                        [
                            'header' => 'Прогноз',
                            'value' => function ($model) use ($user) {
                                return (key_exists($model->id, $user->forecasts))? $user->forecasts[$model->id]->fscoreHome . ' : ' . $user->forecasts[$model->id]->fscoreGuest :'- : -';
                            },
                            'vAlign' => 'middle',
                            'headerOptions' => [
                                'class' => 'kv-align-center',
                            ],
                            'hAlign' => 'center'
                        ],

                        [
                            'attribute' => 'teamGuest.team',
                            'header' => 'Гости',
                            'headerOptions' => [
                                'class' => 'kv-align-center',
                            ],
                            'vAlign' => 'middle',
                            'hAlign' => 'left'
                        ]
                    ]
                ]);?>
            </td>
        </tr>
    </table>
</div>