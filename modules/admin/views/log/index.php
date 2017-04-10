<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/7/2017
 * Time: 4:09 PM
 */

use kartik\icons\Icon;
use kartik\grid\GridView;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php
$this->title = 'Журнал';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        //'pjax' => true,
        'options' => [
            'class' => 'col-xs-12 col-md-10 col-lg-8'
        ],
        'rowOptions' => function($model, $key, $index, $grid) {
            return ['class' => \app\modules\admin\helpers\LogHelper::getClass($model->level)];
        },
        'pager' => [
            'firstPageLabel' => Icon::show('fast-backward', [], Icon::FA),
            'prevPageLabel' => Icon::show('step-backward', [], Icon::FA),
            'nextPageLabel' => Icon::show('step-forward', [], Icon::FA),
            'lastPageLabel' => Icon::show('fast-forward', [], Icon::FA),
        ],
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'panel'=>[
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Icon::show('history', [], Icon::FA) . $this->title,
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'mergeHeader' => true,
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'hAlign' => 'center',
                'vAlign' => 'middle'
            ],

            [
                'attribute' => 'log_time',
                'value' => function ($model) {
                    return date('d.m.y H:i', $model->log_time);
                },
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'options' => [
                    'class' => 'col-xs-2',
                ],
                'filterType' => GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'removeButton' => false,
                    'pluginOptions' => [
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                        'autoclose' => true
                    ],
                ],
            ],

            [
                'attribute' => 'level',
                'value' => function ($model) {
                    return \app\modules\admin\helpers\LogHelper::getStatus($model->level);
                },
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'options' => [
                    'class' => 'col-xs-2',
                ],

                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \app\modules\admin\helpers\LogHelper::getStatuses(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '---Все---'],
            ],

            [
                'attribute' => 'message',
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'options' => [
                    'class' => 'col-xs-7',
                ],
                'filter' => false,
            ]
        ]
    ])?>
</div>
