<?php

use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\editable\Editable;
use app\modules\admin\models\Country;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Команды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'pjax' => true,
        'options' => [
            'class' => 'col-xs-12 col-md-10 col-lg-6'
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
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'team',
                'options' => [
                    'class' => 'col-xs-4',
                ],
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'vAlign' => 'middle',
                'editableOptions' => function($model, $key, $index) {
                    return [
                        'formOptions' => [
                            'action' => ['team/update'],
                        ],
                         'preHeader' => '',
                        'submitButton' => [
                            'icon' => Icon::show('download',['class' => 'text-primary'], Icon::FA)
                        ],
                        'resetButton' => [
                            'icon' => Icon::show('ban',['class' => 'text-danger'], Icon::FA)
                        ],
                    ];
                }
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
                'filter' => ArrayHelper::map(Country::find()->orderBy(['country' => SORT_ASC])->asArray()->all(), 'id', 'country'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Все страны'],
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->country->country;
                },
                'editableOptions' => function ($model, $key, $index) {
                    return [
                        'formOptions' => [
                            'action' => ['team/update'],
                        ],
                        'preHeader' => '',
                        'submitButton' => [
                            'icon' => Icon::show('download',['class' => 'text-primary'], Icon::FA)
                        ],
                        'resetButton' => [
                            'icon' => Icon::show('ban',['class' => 'text-danger'], Icon::FA)
                        ],
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'data' => ArrayHelper::map(Country::find()->orderBy(['country' => SORT_ASC])->asArray()->all(), 'id', 'country'),
                    ];
                },
                'vAlign' => 'middle'
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'logo',
                'label' => 'Логотип',
                'filter' => false,
                'enableSorting' => false,
                'mergeHeader' => true,
                'options' => [
                    'class' => 'col-xs-2'
                ],
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->fileUrl, ['height' => '50', 'width' => '50']);
                },
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'editableOptions' => function ($model, $key, $index) {
                    return [
                        'formOptions' => [
                            'action' => ['team/update'],
                        ],
                        'preHeader' => '',
                        'submitButton' => [
                            'icon' => Icon::show('download',['class' => 'text-primary'], Icon::FA)
                        ],
                        'resetButton' => [
                            'icon' => Icon::show('ban',['class' => 'text-danger'], Icon::FA)
                        ],
                        'inputType' => Editable::INPUT_FILEINPUT,
                        'options' => [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'showRemove' => false,
                                'showUpload' => false
                            ]
                        ],
                    ];
    },
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
