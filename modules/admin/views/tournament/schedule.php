<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 22.03.2017
 * Time: 15:48
 */

use app\modules\admin\models\Tournament;
use app\modules\admin\widgets\TourGames;
use kartik\helpers\Html;
use yii\bootstrap\Modal;
use kartik\icons\Icon;
use app\modules\admin\models\Game;

/* @var $this yii\web\View */
/* @var $dataProviders yii\data\ActiveDataProvider[] */
/* @var $tournament Tournament */
/* @var $participants \app\modules\admin\models\TeamTournament[] */
/* @var $newGame Game */
?>

<?php

$this->title = "Расписание $tournament->tournament";
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];
$this->params['breadcrumbs'][] = ['label' => $tournament->tournament, 'url' => ['tournament/details', 'id' => $tournament->id]];
$this->params['breadcrumbs'][] = 'Расписание';
?>
<div class="row">
    <h3>Расписание игр <?= $tournament->tournament; ?></h3>
</div>

<div class="row" style="margin-bottom: 15px">
    <div class="col-xs-4">
        <?php for ($i = 1; $i <= $tournament->tours; $i++) :?>
            <?php if (isset($dataProviders[$i])) :?>
                <?= Html::a("Тур $i","#tour$i", ['class' => 'btn btn-primary btn-sm', 'style' => 'width: 57px; margin-bottom: 3px;']);?>
            <?php endif;?>
        <?php endfor;?>
    </div>
</div>

<?php if ($tournament->isAutoProcess()) :?>
    <div class = "row">
        <div class = "well col-xs-4 h4">
            <?= Html::a('Загрузка календаря и результатов', ['tournament/autoprocess', 'id' => $tournament->id], ['data-method' => 'post']);?>
        </div>
    </div>
<?php endif ;?>

<?php Modal::begin([
    'id' => 'createGame',
    'toggleButton' => ['label' => Icon::show('plus-square', [], Icon::FA), 'class' => 'btn btn-success', 'style' => 'margin-bottom: 15px'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>

<?= $this->render('_gameCreateForm',['model' => $newGame, 'participants' => $participants, 'tournament_id' => $tournament->id]);

Modal::end(); ?>

<?php foreach ($dataProviders as $tour => $dataProvider): ?>
    <div class="row">
        <?= TourGames::widget(['dataProvider' => $dataProvider, 'tour' => $tour, 'tournament_id' => $tournament->id]);?>
    </div>
<?php endforeach; ?>
