<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 22.03.2017
 * Time: 15:48
 */

use app\modules\admin\models\Tournament;
use app\modules\admin\widgets\TourGames;

/* @var $this yii\web\View */
/* @var $dataProviders yii\data\ActiveDataProvider[] */
/* @var $tournament Tournament */
?>

<?php

$this->title = "Расписание $tournament->tournament";
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];
$this->params['breadcrumbs'][] = ['label' => $tournament->tournament, 'url' => ['tournament/', 'id' => $tournament->id]];
$this->params['breadcrumbs'][] = 'Расписание';
?>
<div class="row">
    <h3>Расписание игр <?= $tournament->tournament; ?></h3>
</div>

<?php foreach ($dataProviders as $tour => $dataProvider): ?>
    <div class="row">
        <?= TourGames::widget(['dataProvider' => $dataProvider, 'tour' => $tour]);?>
    </div>
<?php endforeach; ?>
