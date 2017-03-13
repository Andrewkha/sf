<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 1:44 PM
 */

namespace app\resources;

use app\modules\admin\models\Tournament;

interface StandingsInterface
{
    public function getStandings(Tournament $tournament);
}