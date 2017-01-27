<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\icons\Icon;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страны';
$this->params['breadcrumbs'][] = $this->title;

Icon::map($this, Icon::FA);
?>
<div class="country-index">

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
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
                'content' => Html::a(Icon::show('plus-square', [], Icon::FA), ['create'], ['type' => 'button', 'class' => 'btn btn-success']),
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
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
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
                        'asPopover' => false,
                        'submitButton' => [
                            'icon' => Icon::show('download',[], Icon::FA)
                        ],
                        'resetButton' => [
                            'icon' => Icon::show('ban',[], Icon::FA)
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
<?php Pjax::end(); ?></div>
