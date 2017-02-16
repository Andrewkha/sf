<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\helpers\TournamentHelper;
use app\modules\admin\models\Tournament;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\TournamentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $editModel TournamentCreateEditForm */

$this->title = 'Турниры';
$this->params['breadcrumbs'][] = $this->title;
$countries = TournamentCreateEditForm::getCountriesArray();
?>
<div class="tournament-index">
    <div class = "row">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'pjax' => true,
        'options' => [
            'class' => 'col-xs-12 col-md-10 col-lg-8'
        ],
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
            'heading' => $this->title,
        ],
        'toolbar' => [
            [
                'content' => Html::a(Icon::show('plus-square', [], Icon::FA), ['#'], [
                    'type' => 'button',
                    'class' => 'btn btn-success',
                ]),
                'options' => [
                    'class' => 'btn-group-sm'
                ]
            ],
        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'options' => [
                    'class' => 'col-xs-1',
                ],
            ],

            [
                'attribute' => 'id',
                'filter' => false,
                'mergeHeader' => true,
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'hAlign' => 'center'
            ],

            [
                'attribute' => 'tournament',
                'options' => [
                    'class' => 'col-xs-3',
                ],
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'format' => 'raw',
                'value' => function(Tournament $model) use ($editModel){
                    $editModel->assignProperties($model);
                    return $this->render('_edit.php', [
                        'model' => $editModel,
                    ]);
                }
            ],

            [
                'header' => 'Игры',
                'filter' => false,
                'mergeHeader' => true,
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'hAlign' => 'center',
                'format' => 'raw',
                'value' => function(Tournament $model) {
                    return Html::a(Icon::show('calendar', [], Icon::FA), ['tournament/schedule', 'id' => $model->id]);
                }
            ],

            [
                'attribute' => 'country_id',
                'format' => 'raw',
                'options' => [
                    'class' => 'col-xs-2'
                ],
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $countries,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Все страны'],
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->country->country;
                },
                'vAlign' => 'middle'
            ],

            [
                'class' => 'app\modules\admin\widgets\grid\TournamentStatusColumn',
                'attribute' => 'status',
                'options' => [
                    'class' => 'col-xs-2',
                ],
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => TournamentHelper::getStatusList(),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Все'],
            ],

            [
                'attribute' => 'tours',
                'filter' => false,
                'mergeHeader' => true,
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'hAlign' => 'center'
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'template' => '{delete}',
                'deleteOptions' => ['label' => Icon::show('trash', ['class' => 'fa-lg'], Icon::FA)],
                'header' => false,
            ],
        ],
    ]); ?>
    </div>
</div>