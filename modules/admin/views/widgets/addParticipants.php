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

/* @var $this yii\web\View */
/* @var $candidates array */

?>
<?php $form = ActiveForm::begin([
    'action' => 'add-participants',
])?>
    <div class = "form-group">
        <div class = "col-xs-12 col-sm-8 col-md-6 col-lg-4">
            <?= Select2::widget([
                'name' => 'candidates',
                'data' => ArrayHelper::map($candidates, 'id', 'team', 'country.country'),
                'options' => ['placeholder' => 'Добавьте в турнир участников', 'multiple' => true],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]);?>
        </div>
    </div>
<?php ActiveForm::end();?>

