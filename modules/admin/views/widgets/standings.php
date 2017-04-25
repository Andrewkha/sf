<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 3:24 PM
 */
use kartik\grid\GridView;
use kartik\icons\Icon;
use app\modules\admin\widgets\TournamentStandings;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $models \yii\data\ArrayDataProvider */
/* @var $tournament \app\modules\admin\models\Tournament */
/* @var $mode integer */

?>

<div class = "row">
    <?= GridView::widget([
        'dataProvider' => $models,
        'resizableColumns' => false,
        'options' => [
            'class' => 'col-xs-12 col-md-10 col-lg-7'
        ],
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'toolbar' => false,
        'panelHeadingTemplate' => '<h3 class = "panel-title">{heading}</h3>',
        'panel'=>[
            'type'=>GridView::TYPE_PRIMARY,
            'heading'=> 'Турнирная таблица: ' . $tournament->tournament,
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
                'header' => 'ID',
                'value' => function($model) {
                    return $model->team->id;
                },
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-1'
                ],
                'visible' => ($mode === TournamentStandings::MODE_ADMIN) ? true : false,
            ],

            [
                'header' => 'Команда',
                'format' => 'raw',
                'value' => function($model) use ($mode) {
                    if ($mode === TournamentStandings::MODE_NEWZ)
                        return Html::img($model->team->fileUrl, ['width' => '30']) . ' ' . $model->team->team;
                    else
                        return $this->render('_teamResults', ['model' => $model]);
                },
                'headerOptions' => [
                    'class' => 'kv-align-center',
                ],
                'vAlign' => 'middle',
                'options' => [
                    'class' => 'col-xs-4'
                ]
            ],

            [
                'header' => 'Сыграно матчей',
                'value' => function($model) {
                    return $model->gamesPlayed;
                },
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-1'
                ]
            ],

            [
                'header' => 'В - Н - П',
                /** @param $model \app\resources\dto\StandingsItem */
                'value' => function($model) {

                    return $model->gamesWin. ' - ' . $model->gamesDraw . ' - ' . $model->gamesLost ;
                },
                'format' => 'raw',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'options' => [
                    'class' => 'col-xs-3'
                ]
            ],

            [
                'header' => 'Очки',
                'value' => function($model) {
                    return $model->points;
                },
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'options' => [
                    'class' => 'col-xs-1'
                ]
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Удалить участника',
                'options' => [
                    'class' => 'col-xs-1',
                ],
                'template' => '{delete}',
                'deleteOptions' => ['label' => Icon::show('trash', ['class' => 'fa-lg'], Icon::FA)],
                'visible' => ($tournament->isNotStarted() && $mode === TournamentStandings::MODE_ADMIN) ? true : false,
                'urlCreator' => function ($action, $model, $key, $index) use ($tournament) {
                    return \yii\helpers\Url::to(['tournament/remove-participant', 'id' => $model->team->id, 'tournament' => $tournament->id]);
                }
            ]
        ],
    ]);?>
</div>
