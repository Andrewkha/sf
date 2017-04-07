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
            'heading' => Icon::show('history', [], Icon::FA) . $this->title,
        ],
        'columns' => [
            [
                'class' => 'kartik\grid\SerialColumn',
                'options' => [
                    'class' => 'col-xs-1',
                ],
            ],

            [
                'attribute' => 'log_time',
                'value' => function ($model) {
                    return date('d.m.y H:i', $model->log_time);
                }
            ],

            [
                'attribute' => 'category',

            ]
        ]
    ])?>
</div>
