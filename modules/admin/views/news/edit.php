<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/6/2017
 * Time: 4:47 PM
 */

/* @var $this yii\web\View */
/* @var $form \app\modules\admin\forms\NewzCreateEditForm */

?>

<?php
$this->title = "Редактирование новости";
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news/']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <h3>Редактирование новости</h3>
    </div>
<?= $this->render('_form', ['model' => $form]);?>