<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/15/2017
 * Time: 4:58 PM
 */

use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $nextTour integer */
/* @var $tournament \app\modules\admin\models\Tournament */
?>

<?= Html::a("Отправить напоминания на $nextTour тур", ['tournament/remind', 'id' => $tournament->id, 'tour' => $nextTour] ,['class' => 'btn btn-success', 'data-method' => 'post']);
