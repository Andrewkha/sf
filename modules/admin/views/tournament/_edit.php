<?php

use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

/* @var $id string */

?>

<?php Modal::begin([
    'header' => $model->tournament,
    'toggleButton' => ['label' => $model->tournament, 'class' => 'btn btn-link'],
    'options' => ['tabindex' => false],
    'size' => Modal::SIZE_LARGE,
]);
?>

<?= $this->render('_form',['model' => $model]);

Modal::end();
?>