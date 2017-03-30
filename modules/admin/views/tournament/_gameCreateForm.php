<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 28.03.2017
 * Time: 17:22
 */
use app\modules\admin\models\Game;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\helpers\Html;

/* @var $tournament_id int */
/* @var $participants \app\modules\admin\models\TeamTournament[] */
/* @var $this yii\web\View */
/* @var $model Game */
?>

<?php $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_VERTICAL,
    'action' => ['game/create'],
    'enableAjaxValidation' => true,
]);?>

<?= FormGrid::widget([
    'model' => $model,
    'form' => $form,
    'rows' => [
        [
            'contentBefore' => '<legend class="text-info"><small>Создать игру</small></legend>',
            'autoGenerateColumns' => false,
            'columns' => 12,
            'attributes' => [
                'teamHome_id' => [
                    'type' => Form::INPUT_DROPDOWN_LIST,
                    'label' => false,
                    'items' => \yii\helpers\ArrayHelper::map($participants, 'team_id', 'team.team'),
                    'options' => [
                        'prompt' => '---Команда хозяев---',
                    ],
                    'columnOptions'=>['colspan' => 3],
                ],
                'teamGuest_id' => [
                    'type' => Form::INPUT_DROPDOWN_LIST,
                    'label' => false,
                    'items' => \yii\helpers\ArrayHelper::map($participants, 'team_id', 'team.team'),
                    'options' => [
                        'prompt' => '---Команда гостей---',
                    ],
                    'columnOptions'=>['colspan' => 3],
                ],
                'tour' => [
                    'type' => Form::INPUT_TEXT,
                    'label' => false,
                    'options' => [
                        'placeholder' => 'Тур',
                        'maxlength' => 2,
                        'type' => 'number',
                        'class' => 'tour',
                        'style' => 'width:4em;',
                    ],
                    'columnOptions'=>['colspan' => 1],

                ],

                'date' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => 'kartik\datetime\DateTimePicker',
                    'label' => false,
                    'options' => [
                        'language' => 'ru',
                        'removeButton' => false,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'weekStart' => 1,
                            'minuteStep' => 15,
                            'format' => 'dd.mm.yy hh:ii'
                        ],
                    ],
                    'columnOptions'=>['colspan' => 4],
                ],

                'tournament_id' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'value' => $tournament_id,
                    ],
                    'label' => false,
           //         'columnOptions'=>['colspan' => 1],
                ],
            ]
        ],

        [
            'attributes' => [
                'actions'=>[    // embed raw HTML content
                    'type'=>Form::INPUT_RAW,
                    'value'=>  Html::submitButton('Создать', ['class'=>'btn btn-primary pull-right']),
                ],
            ]
        ]
    ]
]);?>
<?php ActiveForm::end();?>
