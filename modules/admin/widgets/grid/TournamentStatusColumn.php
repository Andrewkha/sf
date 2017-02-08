<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/8/2017
 * Time: 4:37 PM
 */

namespace app\modules\admin\widgets\grid;

use app\modules\admin\helpers\TournamentHelper;
use app\modules\admin\models\Tournament;
use kartik\grid\DataColumn;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

class TournamentStatusColumn extends DataColumn
{
    private $cssClasses = [
            Tournament::STATUS_NOT_STARTED => 'warning',
            Tournament::STATUS_IN_PROGRESS => 'success',
            Tournament::STATUS_FINISHED => 'info',
        ];

    /**
     * @param Tournament $model
     * @param mixed $key
     * @param int $index
     * @return string
     */

    public function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        $name = TournamentHelper::getStatusFriendly($model->status);
        $class = ArrayHelper::getValue($this->cssClasses, $value);
        $html = Html::tag('span', Html::encode($name), ['class' => 'label label-' . $class]);

        return $value === null? $this->grid->emptyCell : $html;
    }
}