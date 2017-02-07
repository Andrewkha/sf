<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tournament-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tournament')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'tours')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'starts')->textInput() ?>

    <?= $form->field($model, 'autoprocess')->textInput() ?>

    <?= $form->field($model, 'autoprocessURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'winnersForecastDue')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
