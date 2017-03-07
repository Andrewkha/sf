<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/7/2017
 * Time: 12:42 PM
 */
use yii\bootstrap\Modal;
use kartik\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\resources\dto\ForecastStandingsItem */
/* @var $games array */
?>

<?php Modal::begin([
    'header' => $model->user->username . ' - детали прогноза',
    'toggleButton' => ['label' => $model->user->username, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>

<?php
Modal::end();
?>