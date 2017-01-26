<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\forms\CountryCreateEditForm */

$this->title = 'Update Country: ' . $model->country;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->country, 'url' => ['view', 'id' => $model->country]];
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="country-create-edit-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
