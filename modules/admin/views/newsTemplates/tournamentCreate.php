<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/25/2017
 * Time: 1:43 PM
 */
/* @var $tournament \app\modules\admin\models\Tournament */
?>

<p>Для прогноза доступен новый турнир <?= $tournament->tournament ?>, первый тур которого состоится <?= date('d.m.y', $tournament->starts) ?></p>
<p>Вы также можете попробовать угадать призеров турнира и заработать дополнительные очки! Прогноз на призеров принимается до <?= date('d.m.y', $tournament->winnersForecastDue) ;?></p>
<p>Спешите принять участие! Зайдите в <strong>Профиль->Мои турниры</strong> чтобы начать делать прогнозы</p>
