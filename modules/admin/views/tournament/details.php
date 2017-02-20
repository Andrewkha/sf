<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:30 PM
 */

use app\modules\admin\widgets\TournamentParticipants;
use kartik\helpers\Html;

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

<?= Html::a('Назначить псевдонимы автопроцессинга', ['tournament/alias', 'id' => $tournament->id]);?>
