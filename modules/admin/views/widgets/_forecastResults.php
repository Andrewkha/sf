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
        <?php endif;; ?>
    </div>
<?php
Modal::end();
?>