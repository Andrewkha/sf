<?php

use yii\bootstrap\Modal;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

?>

<?php Modal::begin([
    'header' => $model->tournament,
    'toggleButton' => ['label' => Icon::show('tasks', [], Icon::FA), 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>

<?= $this->render('_form',['model' => $model]);

Modal::end();
?>