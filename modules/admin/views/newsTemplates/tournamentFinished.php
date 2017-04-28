<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/25/2017
 * Time: 1:43 PM
 */

use kartik\helpers\Html;

/* @var $tournament \app\modules\admin\models\Tournament */
/** @var $standings string */
/** @var $winners string */
?>

<?= Html::tag('p', "Закончился турнир $tournament->tournament. Пожалуйста, ознакомьтесь с его результатами. Поздравляем победителей!!!");?>

<?= $winners; ?>

<?= $standings; ?>

<p>
    Подробную информацию о турнире можно посомотреть на его <?= Html::a('странице', ['/tournament/details', 'id' => $tournament->id]) ;?>
</p>