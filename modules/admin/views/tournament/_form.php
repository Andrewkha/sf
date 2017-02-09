<?php

use kartik\detail\DetailView;
use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\helpers\TournamentHelper;
use app\modules\admin\models\Tournament;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

?>

<?= DetailView::widget([
    'model' => $model,
    'mode' => DetailView::MODE_EDIT,
    'panel' => [
        'heading' => Icon::show('trophy', ['class' => 'fa-lg'] , Icon::FA) . ' Редактирование турнира: ' . $model->tournament,
        'type' => DetailView::TYPE_PRIMARY,
    ],
    'container' => [
        'class' => 'col-xs-7'
    ],
    'condensed' => true,
    'formOptions' => [
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
        'action' => ['tournament/update'],
    ],
    'buttons2' => '{reset} {save}',
    'saveOptions' => [
        'label' => Icon::show('floppy-o', ['class' => 'fa-lg'], Icon::FA),
    ],
    'resetOptions' => [
        'label' => Icon::show('ban', ['class' => 'fa-lg'], Icon::FA),
    ],
    'attributes' => [
        [
            'columns' => [
                [
                    'attribute' => 'tournament',
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'type' => DetailView::INPUT_SELECT2,
                    'value' => TournamentHelper::getTypeFriendly($model->status),
                    'widgetOptions' => [
                        'data' => \app\modules\admin\helpers\TournamentHelper::getStatusList(),
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['placeholder' => 'Статус'],
                    ],
                    'labelColOptions' => ['style' => 'width:20%'],
                    'valueColOptions' => ['style' => 'width:30%'],
                    'inputContainer' => ['class'=>'col-xs-8'],
                ],
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'country_id',
                    'format' => 'raw',
                    'type' => DetailView::INPUT_SELECT2,
                    'value' => $model->country->country,
                    'widgetOptions' => [
                        'data' => TournamentCreateEditForm::getCountriesArray(),
                        'options' => ['placeholder' => 'Страна'],
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                    'inputContainer' => ['class'=>'col-xs-8'],
                ],
                [
                    'attribute' => 'tours',
                    'labelColOptions' => ['style' => 'width:20%'],
                    'valueColOptions' => ['style' => 'width:30%'],
                    'inputContainer' => ['class'=>'col-xs-4'],
                ]
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'type',
                    'format' => 'raw',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => TournamentHelper::getTypeFriendly(Tournament::TYPE_REGULAR),
                            'offText' => TournamentHelper::getTypeFriendly(Tournament::TYPE_PLAYOFF),
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                ],
                [
                    'attribute' => 'autoprocess',
                    'format' => 'raw',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Вкл',
                            'offText' => 'Выкл',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width:20%'],
                    'valueColOptions' => ['style' => 'width:30%'],
                ]
            ]
        ],
        [
            'attribute' => 'autoprocessURL',
            'labelColOptions' => ['style' => 'width:15%'],
            'valueColOptions' => ['style' => 'width:85%'],
            'inputContainer' => ['class'=>'col-xs-8'],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'starts',
                    'value' => (isset($model->starts))? date('d.m.Y', $model->starts) : '',
                    'type' => DetailView::INPUT_DATE,
                    'widgetOptions' => [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy',
                            'todayHighlight' => true,
                        ],
                        'options' => [
                            'value' => (isset($model->starts))? date('d.m.Y', $model->starts) : '',
                        ]
                    ],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                    'inputContainer' => ['class'=>'col-xs-8'],
                ],

                [
                    'attribute' => 'winnersForecastDue',
                    'type' => DetailView::INPUT_DATE,
                    'widgetOptions' => [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy',
                            'todayHighlight' => true,
                        ],
                        'options' => [
                            'value' => (isset($model->winnersForecastDue))? date('d.m.Y', $model->winnersForecastDue) : '',
                        ]
                    ],
                    'value' => (isset($model->winnersForecastDue))? date('d.m.Y', $model->winnersForecastDue) : '',
                    'labelColOptions' => ['style' => 'width:20%'],
                    'valueColOptions' => ['style' => 'width:30%'],
                    'inputContainer' => ['class'=>'col-xs-9'],
                ]
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'logo',
                    'format' => 'raw',
                    'language' => 'ru',
                    'type' => DetailView::INPUT_FILEINPUT,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'initialPreview' => [
                                $model->fileUrl,
                            ],
                            'initialPreviewAsData'=>true,
                            'initialCaption' => '',
                        ],
                        'options' => ['accept' => 'image/*'],
                    ],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:85%'],
                    'inputContainer' => ['class'=>'col-xs-4'],
                ]
            ]
        ]
    ],

]);
?>