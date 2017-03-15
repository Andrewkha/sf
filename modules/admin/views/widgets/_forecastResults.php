<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/7/2017
 * Time: 12:42 PM
 */
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model \app\resources\dto\ForecastStandingsItem */

?>

<?php Modal::begin([
    'header' => '<h4>' . $model->user->username . '</h4>',
    'toggleButton' => ['label' => $model->user->username, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_DEFAULT,
]);
?>
    <div class = "row">
        <?php if (!empty($model->winnersForecast->allModels)) :?>
            <h3 class = "text-center">Прогноз - призеры турнира</h3>
            <?= \kartik\grid\GridView::widget([
                'dataProvider' => $model->winnersForecast,
                'showPageSummary' => false,
                'summary' => false,
                'condensed' => true,
                'options' => [
                    'class' => 'col-xs-offset-1 col-xs-10'
                ],
                'columns' => [
                    [
                        'header' => 'Место',
                        'class' => 'kartik\grid\SerialColumn',
                        'options' => [
                            'class' => 'col-xs-4'
                        ]
                    ],

                    [
                        'attribute' => 'team.team',
                        'header' => 'Команда',
                        'headerOptions' => [
                            'class' => 'kv-align-center',
                        ],
                        'vAlign' => 'middle',
                        'hAlign' => 'center',
                        'options' => [
                            'class' => 'col-xs-8'
                        ],
                    ]
                ]
            ]); ?>
        <?php endif;?>
    </div>
        <?php if (!empty($model->winnersForecastResult)) :?>
            <?php foreach ($model->winnersForecastResult as $k => $item) :?>
                <div class = "row col-xs-offset-1">
                    <?php if ($k === 'totalPoints') :?>
                        <strong><?= $item->eventMessage . ' ' . $item->eventPoints ?></strong>
                    <?php else :?>
                        <?= $item->eventMessage . ' ' . $item->eventPoints ?>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        <?php endif?>
    <hr>
    <div class = "text-center row">
        <?php if ($model->tours->getTotalCount() === 0) :?>
            <h3>Прогноз не был сделан</h3>
        <?php else: ?>
            <?= \kartik\grid\GridView::widget([
            'dataProvider' => $model->tours,
            'showPageSummary' => true,
            'options' => [
                'class' => 'col-xs-offset-3 col-xs-6'
            ],
            'summary' => false,
            'condensed' => true,
            'columns' => [
                [
                    'attribute' => 'tour',
                    'header' => 'Тур',
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'vAlign' => 'middle',
                    'options' => [
                        'class' => 'col-xs-6'
                    ],
                    'pageSummary' => 'Всего'
                ],

                [
                    'attribute' => 'tourPoints',
                    'header' => 'Очки',
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'vAlign' => 'middle',
                    'options' => [
                        'class' => 'col-xs-6'
                    ],
                    'pageSummary' => true,
                    'pageSummaryOptions' => [
                        'align' => 'center'
                    ]
                ]
            ]
        ]); ?>
        <?php endif; ?>
    </div>
<?php
Modal::end();
?>