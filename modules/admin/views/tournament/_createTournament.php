<?php

use yii\bootstrap\Modal;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

?>

<?php Modal::begin([
    'header' => 'Форма создания турнира',
    'id' => 'create',
    'toggleButton' => ['label' => Icon::show('plus-square', [], Icon::FA), 'class' => 'btn btn-success'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>

<?= $this->render('_form',['model' => $model]);

Modal::end();
?>