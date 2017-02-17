<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:30 PM
 */

use app\modules\admin\widgets\TournamentParticipants;

/* @var $this yii\web\View */
/* @var $tournament app\modules\admin\models\Tournament */
/* @var $content string */

$this->title = $tournament->tournament;
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];;
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if ($tournament->isNotStarted()) :?>
    <?= TournamentParticipants::widget(['tournament' => $tournament]);?>
<?php endif; ?>
