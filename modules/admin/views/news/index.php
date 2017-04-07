<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 1:37 PM
 */

use kartik\grid\GridView;
use kartik\icons\Icon;
use kartik\helpers\Html;
use app\modules\admin\models\Newz;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\NewzSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php
$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

$categories = \app\modules\admin\forms\NewzCreateEditForm::getCategories();
$authors = \app\modules\admin\forms\NewzCreateEditForm::getAuthors();
$statuses = \app\modules\admin\forms\NewzCreateEditForm::getStatuses();

?>

<div class = "news-index">
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
                'heading' => Icon::show('newspaper-o', [], Icon::FA) . $this->title,
            ],
            'toolbar' => [
                [
                    'content' => Html::a(Icon::show('plus-square', [], Icon::FA), ['news/create'], [
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
                    'attribute' => 'tournament_id',
                    'options' => [
                        'class' => 'col-xs-3',
                    ],
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'value' => function (\app\modules\admin\models\Newz $model) {
                        return $model->getNewzCategory();
                    },
                    'vAlign' => 'middle',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => $categories,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => '---Все---'],
                ],

                [
                    'attribute' => 'subject',
                    'options' => [
                        'class' => 'col-xs-2'
                    ],
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'format' => 'raw',
                    'vAlign' => 'middle',
                    'value' => function (Newz $model) {
                        return Html::a($model->subject, ['news/update', 'id' => $model->id]);
                    }
                ],

                [
                    'attribute' => 'user_id',
                    'value' => function ($model) {
                        return $model->user->username;
                    },
                    'options' => [
                        'class' => 'col-xs-2'
                    ],
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => $authors,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => '---Все---'],
                ],

                [
                    'attribute' => 'date',
                    'options' => [
                        'class' => 'col-xs-1'
                    ],

                    'value' => function($model) {
                        return date('d.m.y H:i', $model->date);
                    },
                    'headerOptions' => [
                        'class' => 'kv-align-center',
                    ],
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                ],

                [
                    'attribute' => 'status',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'options' => [
                        'class' => 'col-xs-1'
                    ],
                    'format' => 'raw',
                    'value' => function (\app\modules\admin\models\Newz $model)  {
                        if ($model->isArchived()) {
                            return Html::a(Icon::show('thumbs-down', ['class' => 'fa-lg', 'style' => 'color: red;'], Icon::FA),
                                ['news/archive', 'id' => $model->id], ['data-method' => 'post']);
                        } else {
                            return Html::a(Icon::show('thumbs-up', ['class' => 'fa-lg', 'style' => 'color: green;'], Icon::FA),
                                ['news/archive', 'id' => $model->id], ['data-method' => 'post']);
                        }
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => $statuses,
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => '---Все---'],
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
