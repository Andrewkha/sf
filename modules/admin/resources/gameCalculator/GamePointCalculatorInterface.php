<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 12:44 PM
 */

namespace app\modules\admin\resources\gameCalculator;


use app\modules\admin\models\Game;

interface GamePointCalculatorInterface
{
    public function getGamePoints(Game $game);
}