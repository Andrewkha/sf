<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/27/2017
 * Time: 5:39 PM
 */
use yii\bootstrap\Modal;
use kartik\helpers\Html;
use app\resources\dto\Match;


/* @var $this yii\web\View */
/* @var $model \app\resources\dto\StandingsItem */
?>

<?php Modal::begin([
    'header' => Html::img($model->team->fileUrl, ['width' => '30']) . ' ' . $model->team->team . ' - детали по турам',
    'toggleButton' => ['label' => Html::img($model->team->fileUrl, ['width' => '30']) . ' ' . $model->team->team, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>
<div class = "text-center">
<?php foreach ($model->matches as $match) :?>
    <?= \yii\bootstrap\Button::widget([
        'label' => $match->tour,
        'options' => [
            'class' =>  ($match->outcome === Match::GAME_WIN) ? 'btn btn-success' : (($match->outcome === Match::GAME_DRAW) ? 'btn btn-warning' : 'btn btn-danger'),
            'title' => $match->title,
            'style' => 'margin-bottom: 5px'
        ]
    ]);?>
<?php endforeach;?>
</div>
<?php
Modal::end();
?>

