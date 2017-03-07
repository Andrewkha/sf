<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/7/2017
 * Time: 12:45 PM
 */
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model \app\resources\dto\ForecastStandingsItem */
?>

<?php Modal::begin([
    'header' => '<h4>' . $model->user->username . ' - саммари по турам' . '</h4>',
    'toggleButton' => ['label' => $model->user->username, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_DEFAULT,
]);
