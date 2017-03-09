<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:30 PM
 */

use app\modules\admin\widgets\TournamentParticipants;
use kartik\helpers\Html;
use app\modules\admin\widgets\TournamentStandings;
use app\modules\admin\widgets\TournamentForecasters;

/* @var $this yii\web\View */
/* @var $tournament app\modules\admin\models\Tournament */

$this->title = $tournament->tournament;
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class = "row">
    <?php if ($tournament->isNotStarted()) :?>
        <?= TournamentParticipants::widget(['tournament' => $tournament]);?>
    <?php endif; ?>
</div>
<div class = "row">
    <div class = "well col-xs-4 h4">
        <?= Html::a('Назначить псевдонимы автопроцессинга', ['tournament/alias', 'id' => $tournament->id]);?>
    </div>
</div>

<div class = "row">
    <?= TournamentStandings::widget(['tournament' => $tournament, 'mode' => TournamentStandings::MODE_ADMIN]);?>
</div>
<hr>
<div class = "row">
    <div class = "well col-xs-4 h4">
        <?= 'Все прогнозисты турнира';?>
    </div>
</div>
<div class = "row">
    <?= TournamentForecasters::widget(['tournament' => $tournament]);?>
</div>
