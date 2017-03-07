<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 1:44 PM
 */

namespace app\resources;

use app\resources\dto\StandingsItem;
use yii\helpers\ArrayHelper;

class SimpleStandings implements StandingsInterface
{
    /**
     * generates the standings table - sorting on points as the first parameter, games one as the second and games lost as the third
     * @param array $items
     * @return StandingsItem[] $items
     */

    public function getStandings($items)
    {
        ArrayHelper::multisort($items, ['points', 'gamesWin', 'gamesLost'], [SORT_DESC, SORT_DESC, SORT_ASC], [SORT_NUMERIC, SORT_NUMERIC, SORT_NUMERIC]);

        return $items;
    }
}