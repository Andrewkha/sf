<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 5:34 PM
 */

use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $candidates array */
/* @var $tournament \app\modules\admin\models\Tournament */

?>
<?php $form = ActiveForm::begin([
    'action' => ['add-participants', 'id' => $tournament->id],
])?>
    <div class = "form-group">
        <div class = "col-xs-12 col-sm-8 col-md-6 col-lg-4">
            <?= Select2::widget([
                'size' => Select2::MEDIUM,
                'theme' => Select2::THEME_KRAJEE,
                'name' => 'candidates',
                'data' => ArrayHelper::map($candidates, 'id', 'team', 'country.country'),
                'options' => ['placeholder' => 'Добавьте участников...', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]);?>
        </div>
    </div>

    <div class = "form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end();?>

