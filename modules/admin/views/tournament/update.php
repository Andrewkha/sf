<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\forms\TournamentCreateEditForm */

$this->title = 'Update Tournament: ' . $model->tournament;
$this->params['breadcrumbs'][] = ['label' => 'Tournaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tournament, 'url' => ['view', 'id' => $model->tournament]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tournament-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
