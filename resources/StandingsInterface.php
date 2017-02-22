<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 1:44 PM
 */

namespace app\resources;


use app\modules\admin\resources\gameCalculator\GamePointsCalculator;

interface StandingsInterface
{
    public function getStandings(GamePointsCalculator $calculator, $participants, $games);
}