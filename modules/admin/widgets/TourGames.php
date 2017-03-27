<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 22.03.2017
 * Time: 16:03
 */

namespace app\modules\admin\widgets;

use kartik\base\widget;

class TourGames extends Widget
{
    public $dataProvider;
    public $tour;
    public $tournament_id;

    public function run()
    {
        return $this->render('/widgets/tourGames', ['dataProvider' => $this->dataProvider, 'tour' => $this->tour, 'tournament_id' => $this->tournament_id]);
    }
}