<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/2/2017
 * Time: 11:21 AM
 */

namespace app\resources;

use app\modules\admin\models\Tournament;

interface ForecastStandingsInterface
{
    public function getStandings(Tournament $tournament);
}