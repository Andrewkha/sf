<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 31.03.2017
 * Time: 16:22
 */

namespace app\modules\admin\resources\parser;

use app\modules\admin\models\Tournament;

interface ParserInterface
{
    public function getGamesFromWeb(Tournament $tournament);
}