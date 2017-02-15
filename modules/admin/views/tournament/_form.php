<?php

use kartik\detail\DetailView;
use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\helpers\TournamentHelper;
use app\modules\admin\models\Tournament;
use kartik\icons\Icon;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

?>

<?php Modal::begin([
    'header' => $model->tournament,
    'toggleButton' => ['label' => $model->tournament, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>

<?= DetailView::widget([
    'model' => $model,
    'mode' => DetailView::MODE_EDIT,
    'panel' => [
        'heading' => Icon::show('trophy', ['class' => 'fa-lg'] , Icon::FA) . ' Редактирование турнира: ' . $model->tournament,
        'type' => DetailView::TYPE_PRIMARY,
    ],
    'condensed' => true,
    'formClass' => 'kartik\form\ActiveForm',
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
                    'format' => 'raw',
                    'type' => DetailView::INPUT_TEXT,
                    'options' => ['id' => 'tournament-tournament' . '-' . $model->id],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'type' => DetailView::INPUT_SELECT2,
                    'options' => ['id' => 'tournament-status' . '-' . $model->id],
                    'widgetOptions' => [
                        'data' => \app\modules\admin\helpers\TournamentHelper::getStatusList(),
                        'options' => ['placeholder' => 'Статус'],
                        'pluginOptions' => ['allowClear' => true],
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
                    'options' => ['id' => 'tournament-country_id' . '-' . $model->id],
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
                    'options' => ['id' => 'tournament-tours' . '-' . $model->id],
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
                    'options' => ['id' => 'tournament-type' . '-' . $model->id],
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
                    'options' => ['id' => 'tournament-autoprocess' . '-' . $model->id],
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
            'format' => 'raw',
            'options' => ['id' => 'tournament-autoprocessurl' . '-' . $model->id],
            'type' => DetailView::INPUT_TEXT,
            'labelColOptions' => ['style' => 'width:15%'],
            'valueColOptions' => ['style' => 'width:85%'],
            'inputContainer' => ['class'=>'col-xs-8'],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'starts',
                    'options' =>
                        [
                            'id' => 'tournament-starts' . '-' . $model->id,
                            'value' => date('d.m.Y', $model->starts)
                        ],
                    'type' => DetailView::INPUT_DATE,
                    'widgetOptions' => [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy',
                            'todayHighlight' => true,
                        ],
                    ],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                    'inputContainer' => ['class'=>'col-xs-8'],
                ],

                [
                    'attribute' => 'winnersForecastDue',
                    'options' => [
                        'id' => 'tournament-winnersforecastdue' . '-' . $model->id,
                        'value' => date('d.m.Y', $model->winnersForecastDue)
                    ],
                    'type' => DetailView::INPUT_DATE,
                    'widgetOptions' => [
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy',
                            'todayHighlight' => true,
                        ],
                    ],
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
                    'options' => ['id' => 'tournament-logo' . '-' . $model->id],
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
Modal::end();
?>