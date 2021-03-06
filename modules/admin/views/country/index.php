<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\form\ActiveForm;
use app\modules\admin\assets\CreateFormShowHideAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\CountrySearch */
/* @var $model app\modules\admin\forms\CountryCreateEditForm*/
/* @var $dataProvider yii\data\ActiveDataProvider */

CreateFormShowHideAsset::register($this);

$this->title = 'Страны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <div class = "create <?= $model->getFormState() ?>" id = 'add-form'>
        <div class = "row country-create-edit-form">
            <?php $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_VERTICAL,
            ]); ?>

            <div class = 'form-group'>
                <div class = "col-xs-10 col-sm-8 col-md-6 col-lg-2">
                    <?= $form->field($model, 'country', [
                        'showLabels' => false,
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Новая запись']) ?>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-xs-12">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Отмена', ['country/'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-xs-12 col-sm-10 col-md-8 col-lg-4">
                    <hr>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>

    <div class = 'row'>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'resizableColumns' => false,
            'pjax' => 'true',
            'options' => [
                'class' => 'col-xs-12 col-sm-10 col-md-8 col-lg-4'
            ],
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            'filterRowOptions'=>['class'=>'kartik-sheet-style'],
            'panel'=>[
                'type'=>GridView::TYPE_PRIMARY,
                'heading'=>Icon::show('globe', [], Icon::FA). ' ' . $this->title,
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
                        'class' => 'col-xs-2',
                    ],
                ],

                [
                    'attribute' => 'id',
                    'filter' => false,
                    'mergeHeader' => true,
                    'options' => [
                        'class' => 'col-xs-2',
                    ],
                    'hAlign' => 'center'
                ],

                [
                    'class' => 'kartik\grid\EditableColumn',
                    'attribute' => 'country',
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'options' => [
                        'class' => 'col-xs-6',
                    ],
                    'editableOptions' => function($model, $key, $index) {
                        return [
                            'formOptions' => [
                                'action' => ['country/update'],
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
                    'class' => 'kartik\grid\ActionColumn',
                    'options' => [
                        'class' => 'col-xs-2',
                    ],
                    'template' => '{delete}',
                    'deleteOptions' => ['label' => Icon::show('trash', ['class' => 'fa-lg'], Icon::FA)],
                    'header' => false,
                ],
            ],
        ]); ?>
    </div>

</div>
