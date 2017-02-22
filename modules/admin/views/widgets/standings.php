<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 3:24 PM
 */
use kartik\grid\GridView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $models \yii\data\ArrayDataProvider */
/* @var $tournament \app\modules\admin\models\Tournament */

?>

<div class = "row">
    <?= GridView::widget([
        'dataProvider' => $models,
        'resizableColumns' => false,
        'options' => [
            'class' => 'col-xs-12 col-md-8 col-lg-6'
        ],
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar' => false,
        'panelHeadingTemplate' => '<h3 class = "panel-title">{heading}</h3>',
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=> 'Турнирная таблица: ' . $tournament->tournament,
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
                    'class' => 'col-xs-1'
                ]
            ],

            [
                'header' => 'ID участника',
                'value' => function($model) {
                    return $model->team->id;
                },
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-1'
                ]
            ],

            [
                'header' => 'Команда',
                'value' => function($model) {
                    return $model->team->team;
                },
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'vAlign' => 'middle',
                'options' => [
                    'class' => 'col-xs-3'
                ]
            ],

            [
                'header' => 'Сыграно матчей',
                'value' => function($model) {
                    return $model->gamesPlayed;
                },
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-1'
                ]
            ],

            [
                'header' => 'Очки',
                'value' => function($model) {
                    return $model->points;
                },
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-1'
                ]
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Удалить участника',
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'template' => '{delete}',
                'deleteOptions' => ['label' => Icon::show('trash', ['class' => 'fa-lg'], Icon::FA)],
                'visible' => ($tournament->isNotStarted()) ? true : false,
                'urlCreator' => function ($action, $model, $key, $index) use ($tournament) {
                    return \yii\helpers\Url::to(['tournament/remove-participant', 'id' => $model->team->id, 'tournament' => $tournament->id]);
                }
            ]
        ],
    ]);?>
</div>
