<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/25/2017
 * Time: 1:43 PM
 */

use kartik\helpers\Html;

/* @var $tournament \app\modules\admin\models\Tournament */
?>

<?= Html::tag('p', "Закончился турнир $tournament->tournament. Пожалуйста, ознакомьтесь с его результатами. Поздравляем победителей!!!");?>

<p>
    Подробную информацию о турнире можно посомотреть на его <?= Html::a('странице', ['/tournament/details', 'id' => $tournament->id]) ;?>
</p>

<?= \app\modules\admin\widgets\TournamentForecasters::widget([
    'tournament' => $tournament,
    'mode' => \app\modules\admin\widgets\TournamentForecasters::MODE_SIMPLE,
]);?>

<?= \app\modules\admin\widgets\TournamentStandings::widget([
    'tournament' => $tournament,
    'mode' => \app\modules\admin\widgets\TournamentStandings::MODE_NEWZ,
])?>
