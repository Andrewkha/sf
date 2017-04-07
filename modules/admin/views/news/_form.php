<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/6/2017
 * Time: 4:47 PM
 */

use kartik\form\ActiveForm;
use letyii\tinymce\Tinymce;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\forms\NewzCreateEditForm */

$categories = \app\modules\admin\forms\NewzCreateEditForm::getCategories();
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
    ]);?>

    <div class = "row form-group">
        <div class = 'col-md-6 col-lg-4'>
            <?= $form->field($model,'tournament_id')->dropDownList($categories);?>
        </div>
    </div>

    <div class="row form-group">
        <div class = 'col-md-6 col-lg-4'>
            <?= $form->field($model,'subject')->textInput();?>
        </div>
    </div>

    <div class="row form-group">
        <div class = "col-md-6">
            <?= $form->field($model, 'body')->widget(Tinymce::className(), [
                'configs'=> [
                    'plugins' => 'link',
                    'menu' => [],
                ]
            ]); ?>
        </div>
    </div>

    <div class = "row form-group">
        <div class = "col-xs-12">
            <?= $form->field($model, 'isSend')->checkbox();?>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success' ]); ?>
        </div>
    </div>
    <?php ActiveForm::end();?>
</div>
