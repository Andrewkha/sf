<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\select2\Select2;
use app\modules\admin\forms\TeamCreateEditForm;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\TournamentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Турниры';
$this->params['breadcrumbs'][] = $this->title;
$countries = TeamCreateEditForm::getCountriesArray();
?>
<div class="tournament-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tournament', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'pjax' => true,
        'options' => [

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
                    'onclick' => "toggle(this, 'add-form')"
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
                    'class' => 'col-xs-4',
                ],
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
            ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'country_id',
                'format' => 'raw',
                'options' => [
                    'class' => 'col-xs-3'
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
                'editableOptions' => function ($model, $key, $index) use ($countries) {
                    return [
                        'formOptions' => [
                            'action' => ['tournament/update'],
                        ],
                        'preHeader' => '',
                        'submitButton' => [
                            'icon' => Icon::show('download',['class' => 'text-primary'], Icon::FA)
                        ],
                        'resetButton' => [
                            'icon' => Icon::show('ban',['class' => 'text-danger'], Icon::FA)
                        ],
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data' => $countries,
                    ];
                },
                'vAlign' => 'middle'
            ],

            'type',
            // 'tours',
            // 'status',
            // 'starts',
            // 'autoprocess',
            // 'autoprocessURL:url',
            // 'winnersForecastDue',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
