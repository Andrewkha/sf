<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/15/2017
 * Time: 4:18 PM
 */

namespace app\modules\admin\widgets;

use app\modules\admin\helpers\TournamentHelper;
use kartik\base\Widget;

class NextTour extends Widget
{
    public $tournament;

    public function run()
    {
        $nextTour = TournamentHelper::getNextTour($this->tournament);
        if ($nextTour !== null)
            return $this->render('/widgets/nextTour.php', ['nextTour' => $nextTour, 'tournament' => $this->tournament]);
        else return;
    }
}