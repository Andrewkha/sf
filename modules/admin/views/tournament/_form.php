<?php

use kartik\detail\DetailView;
use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\helpers\TournamentHelper;
use app\modules\admin\models\Tournament;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

/* @var $id string */
$id = isset($model->id) ? $model-> id : '';
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
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
        'action' => ['tournament/edit'],
    ],
    'buttons2' => '{reset} {save}',
    'saveOptions' => [
        'label' => Icon::show('floppy-o', ['class' => 'fa-lg'], Icon::FA),
        'name' => isset($model->id)? 'TournamentCreateEditForm[id]' : NULL,
        'value' => $id,
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
                    'options' => ['id' => 'tournament-tournament' . '-' . $id],
                    'labelColOptions' => ['style' => 'width:15%'],
                    'valueColOptions' => ['style' => 'width:35%'],
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'type' => DetailView::INPUT_SELECT2,
                    'options' => ['id' => 'tournament-status' . '-' . $id],
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
                    'options' => ['id' => 'tournament-country_id' . '-' . $id],
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
                    'options' => ['id' => 'tournament-tours' . '-' . $id],
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
                    'options' => ['id' => 'tournament-type' . '-' . $id],
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
                    'options' => ['id' => 'tournament-autoprocess' . '-' . $id],
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
            'options' => ['id' => 'tournament-autoprocessurl' . '-' . $id],
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
                            'id' => 'tournament-starts' . '-' . $id,
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
                        'id' => 'tournament-winnersforecastdue' . '-' . $id,
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
                    'options' => ['id' => 'tournament-logo' . '-' . $id, 'accept' => 'image/*'],
                    'format' => 'raw',
                    'language' => 'ru',
                    'type' => DetailView::INPUT_FILEINPUT,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'showRemove' => false,
                            'showUpload' => false,
                            'initialPreview' => [
                                $model->fileUrl,
                            ],
                            'initialPreviewAsData'=>true,
                            'initialCaption' => '',
                        ],
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