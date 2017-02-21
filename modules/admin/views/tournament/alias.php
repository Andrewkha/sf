<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/20/2017
 * Time: 4:56 PM
 */

use kartik\form\ActiveForm;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $tournament app\modules\admin\models\Tournament */
/* @var $models \app\modules\admin\models\TeamTournament[] */

$this->title = 'Псевдонимы процессинга';
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];
$this->params['breadcrumbs'][] = ['label' => $tournament->tournament, 'url' => ['tournament/details', 'id' => $tournament->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_VERTICAL,
]); ?>
<div class = "row">
    <div class = "form-group">
        <?php foreach ($models as $index => $model) :?>
            <div class = "col-xs-10 col-sm-8 col-md-6 col-lg-4 col-lg-offset-1">
                <?= $form->field($model, "[$index]alias", ['showLabels' => false])->textInput(['placeholder' => 'Псевдоним ' . $model->team->team]); ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class = "form-group">
        <div class = "col-xs-12 col-lg-offset-1">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);?>
            <?= Html::a('Отмена', ['tournament/details', 'id' => $tournament->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end();?>

