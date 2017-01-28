<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\forms\CountryCreateEditForm */

$this->title = 'Новая страна';
$this->params['breadcrumbs'][] = ['label' => 'Страны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="country-create-edit-form">
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

        <div class = 'form-group'>
            <?= Html::activeLabel($model, 'country', ['class'=>'col-sm-1 control-label']) ?>
            <div class = 'col-xs-2'>
                <?= $form->field($model, 'country', ['showLabels' => false])->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="form-group">
            <div class= "col-xs-offset-1 col-xs-11">
                <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Отмена', ['country/index'], ['type' => 'button', 'class' => 'btn btn-default']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
