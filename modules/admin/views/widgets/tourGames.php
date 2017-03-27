<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 22.03.2017
 * Time: 16:07
 */

use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $tour int*/
/* @var $tournament_id int*/

?>
<div class = "row">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_INLINE,
        'fieldConfig' => ['autoPlaceholder' => false],
        'action' => ['game/set-score'],
    ]);?>

    <?= Html::hiddenInput('tour', $tour);?>
    <?= Html::hiddenInput('tournament_id', $tournament_id);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'options' => [
            'class' => 'col-xs-12 col-md-10 col-lg-8'
        ],

        'panel'=>[
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "$tour тур",
            'after' => false,
            'footer' => Html::submitButton('Сохранить', ['class' => 'btn btn-primary pull-right'])
        ],
        'panelFooterTemplate' => '
                {footer}
                <div class="clearfix"></div>
            ',
        'resizableColumns' => false,
        'toolbar' => false,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => false,
                'mergeHeader' => true,
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'hAlign' => 'center',
                'vAlign' => 'middle',
            ],

            [
                'attribute' => 'teamHome.team',
                'header' => 'Хозяева',
                'hAlign' => 'right',
                'options' => [
                    'class' => 'col-xs-3',
                ],
                'vAlign' => 'middle',
            ],

            [
                'header' => 'Счет',
                'format' => 'raw',
                'value' => function ($model) use ($form) {
                    return  $form->field($model, "[$model->id]scoreHome")->
                        textInput(['maxlength' => 2, 'type' => 'number', 'class' => 'score', 'style' => 'width:3.3em;', 'placeholder' => ' ']) .
                        $form->field($model, "[$model->id]scoreGuest")->
                        textInput(['maxlength' => 2, 'type' => 'number', 'class' => 'score', 'style' => 'width:3.3em;']);
                },
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-2',
                ],
                'vAlign' => 'middle',
            ],

            [
                'attribute' => 'teamGuest.team',
                'header' => 'Гости',
                'hAlign' => 'left',
                'options' => [
                    'class' => 'col-xs-3',
                ],
                'vAlign' => 'middle',
            ],

            [
                'attribute' => 'date',
                'value' => function ($model) use ($form) {
                    return $form->field($model, "[$model->id]date")->widget(DateTimePicker::className(), [
                        'language' => 'ru',
                        'removeButton' => false,
                        'size' => 'sm',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'weekStart' => 1,
                            'minuteStep' => 15,
                            'format' => 'dd.mm.yy hh:ii'
                        ],
                        'options' => [
                            'value' => (isset($model->date)) ? date('d.m.y H:i', $model->date) : '',
                        ]
                    ]);
                },
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-2',
                ],
                'format' => 'raw',
                'vAlign' => 'middle',
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'template' => '{delete}',
                'deleteOptions' => ['label' => Icon::show('trash', ['class' => 'fa-lg'], Icon::FA)],
                'header' => false,
                'vAlign' => 'middle',
                'urlCreator' => function ($action, $model, $key, $index)  {
                    return \yii\helpers\Url::to(['game/delete', 'id' => $model->id]);
                }
            ],
        ],
    ]);?>
    <?php ActiveForm::end();?>
</div>