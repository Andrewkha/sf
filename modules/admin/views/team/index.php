<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\editable\Editable;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\modules\admin\forms\TeamCreateEditForm;
use app\modules\admin\assets\CreateFormShowHideAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var $model app\modules\admin\forms\TeamCreateEditForm*/

CreateFormShowHideAsset::register($this);
$this->title = 'Команды';
$this->params['breadcrumbs'][] = $this->title;
$countries = TeamCreateEditForm::getCountriesArray();
?>
<div class="team-index">
    <div class = "create closed" id = 'add-form'>
        <div class = "row team-create-edit-form">
            <?php $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_VERTICAL,
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'options' =>[
                    'enctype' => 'multipart/form-data',
                ]
            ]); ?>

            <div class = 'form-group'>
                <div class = "col-xs-10 col-sm-8 col-md-6 col-lg-2">
                    <?= $form->field($model, 'team', [
                        'showLabels' => false,
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Название']) ?>
                </div>
            </div>

            <div class = 'form-group'>
                <div class = "col-xs-10 col-sm-8 col-md-6 col-lg-2">
                    <?= $form->field($model, 'country_id', ['showLabels' => false,])->widget(Select2::class, [
                        'data' => $countries,
                        'pluginOptions' => ['allowClear' => true],
                        'options' => ['placeholder' => 'Выберите страну'],
                    ]); ?>
                </div>
            </div>

            <div class = 'form-group'>
                <div class = "col-xs-10 col-sm-8 col-md-6 col-lg-2">
                    <?= $form->field($model, 'logo', ['showLabels' => false,])->widget(\kartik\file\FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'showRemove' => false,
                            'showUpload' => false
                        ]
                    ]); ?>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-xs-12">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Отмена', ['team/'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-xs-12 col-md-10 col-lg-6">
                    <hr>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class = "row">
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
                            'data' => $countries,
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
                    'value' => function(\app\modules\admin\models\Team $model) {
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
                                'action' => ['team/logo-update'],
                                'options' => [
                                    'enctype' => 'multipart/form-data'
                                ],
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
                                'options' => ['accept' => 'image/*', 'name' => "Team[logo][$index]", 'id' => "team-logo-$index"],
                                'pluginOptions' => [
                                    'showRemove' => false,
                                    'showUpload' => false,
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


</div>
