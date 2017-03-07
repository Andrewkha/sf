<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/7/2017
 * Time: 12:35 PM
 */

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $models \yii\data\ArrayDataProvider */
/* @var $tournament \app\modules\admin\models\Tournament */
/* @var $games array */
?>

<div class = "row">
    <?= GridView::widget([
    'dataProvider' => $models,
    'resizableColumns' => false,
    'options' => [
        'class' => 'col-xs-12 col-md-10'
    ],
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'toolbar' => false,
    'panelHeadingTemplate' => '<h3 class = "panel-title">{heading}</h3>',
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
        'heading'=> 'Все прогнозы турнира: ' . $tournament->tournament,
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
            'header' => 'Пользователь',
            'format' => 'raw',
            'value' => function($model) use ($games) {
                return $this->render('_forecastResults', ['model' => $model, 'games' => $games]);
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
            'header' => 'Очки',
            'value' => function($model) {
                return $model->totalPoints;
            },
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'options' => [
                'class' => 'col-xs-1'
            ]
        ],

        [
            'header' => 'Прогнозы по турам',
            'format' => 'raw',
            'value' => function($model) {
                return $this->render('_forecastTour', ['model' => $model]);
            },
            'headerOptions' => [
                'class' => 'kv-align-center',
            ],
            'vAlign' => 'middle',
            'options' => [
                'class' => 'col-xs-7'
            ]
        ],
    ],
]);?>
</div>