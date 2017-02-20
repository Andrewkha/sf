<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/20/2017
 * Time: 4:56 PM
 */

use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $tournament app\modules\admin\models\Tournament */
/* @var $models \app\modules\admin\models\TeamTournament[] */

$this->title = 'Псевдонимы процессинга';
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];
$this->params['breadcrumbs'][] = ['label' => $tournament->tournament, 'url' => ['tournament/details', 'id' => $tournament->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class = "row">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_VERTICAL,
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>
        <div class = "form-group">
            <?php foreach ($models as $model) :?>
                <?= $form->field($model, 'alias')->textInput(['placeholder' => 'Псевдоним ' . $model->team->team]); ?>
            <?php endforeach; ?>
        </div>
    <?php ActiveForm::end();?>
</div>
