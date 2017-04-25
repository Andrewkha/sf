<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/7/2017
 * Time: 12:35 PM
 */

use kartik\grid\GridView;
use app\resources\dto\ForecastStandingsItem;
/* @var $this yii\web\View */
/* @var $models \yii\data\ArrayDataProvider */
/* @var $tournament \app\modules\admin\models\Tournament */

?>

<?php if ($models->getTotalCount() === 0) :?>
    <h3>В этом турнире никто не участвовал</h3>
<?php else : ?>
    <div class = "row">
        <?= GridView::widget([
            'dataProvider' => $models,
            'resizableColumns' => false,
            'options' => [
                'class' => 'col-xs-12 col-md-8 col-sm-6 col-lg-4'
            ],
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            'toolbar' => false,
            'panelHeadingTemplate' => '<h3 class = "panel-title">{heading}</h3>',
            'panel'=>[
                'type'=>GridView::TYPE_PRIMARY,
                'heading'=> 'Победители прогноза: ' . $tournament->tournament,
                'headingOptions' => [
                    'class' => 'panel-heading'
                ],
                'footer' => false,
                'before' => false,
                'after' => false,
            ],

            'columns' => [
                [
                    'header' => 'Место',
                    'class' => 'kartik\grid\SerialColumn',
                    'options' => [
                        'class' => 'col-xs-2'
                    ]
                ],

                [
                    'header' => 'Пользователь',
                    'format' => 'raw',
                    'value' => function (\app\resources\dto\ForecastStandingsItem $model) {
                        return $model->user->username;
                    },
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'vAlign' => 'middle',
                    'options' => [
                        'class' => 'col-xs-4'
                    ]
                ],


                [
                    'header' => 'Очки за основной прогноз',
                    'value' => function(ForecastStandingsItem $model) {
                        $additionalPoints = isset ($model->winnersForecastResult) ? $model->winnersForecastResult['totalPoints']->eventPoints : 0;
                        return $model->totalPoints - $additionalPoints;
                    },
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'options' => [
                        'class' => 'col-xs-2'
                    ]
                ],

                [
                    'header' => 'Очки за победителей',
                    'value' => function(ForecastStandingsItem $model) {
                        return isset ($model->winnersForecastResult) ? $model->winnersForecastResult['totalPoints']->eventPoints : 0;
                    },
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'options' => [
                        'class' => 'col-xs-2'
                    ]
                ],

                [
                    'header' => 'Всего очков',
                    'value' => function(ForecastStandingsItem $model) {
                        return $model->totalPoints;
                    },
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'options' => [
                        'class' => 'col-xs-2'
                    ]
                ],
            ],
        ]);?>
    </div>
<?php endif; ?>