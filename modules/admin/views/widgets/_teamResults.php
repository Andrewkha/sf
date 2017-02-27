<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/27/2017
 * Time: 5:39 PM
 */

use yii\bootstrap\Modal;
use kartik\helpers\Html;
/* @var $this yii\web\View */
/* @var $model \app\resources\dto\StandingsItem */
?>
<?php Modal::begin([
    'header' => $model->team->team,
    'toggleButton' => ['label' => Html::img($model->team->fileUrl, ['width' => '30']) . ' ' . $model->team->team, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>
<?= 'eee';?>

<?php
Modal::end();
?>