<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:30 PM
 */

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tournament */

$this->title = $model->tournament;
$this->params['breadcrumbs'][] = ['label' => 'Турниры', 'url' => ['tournament/']];;
$this->params['breadcrumbs'][] = $this->title;

?>