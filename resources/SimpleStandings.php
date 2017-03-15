<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 1:44 PM
 */

namespace app\resources;

use app\modules\admin\models\Tournament;
use app\resources\dto\StandingsItem;
use yii\helpers\ArrayHelper;

class SimpleStandings implements StandingsInterface
{
    /**
     * generates the standings table - sorting on points as the first parameter, games one as the second and games lost as the third
     * @param array $items
     * @return StandingsItem[] $items
     */
    use StandingsGetDataTrait;

    public function getStandings(Tournament $tournament)
    {
        $items = $this->getData($tournament);
        ArrayHelper::multisort($items, ['points', 'gamesWin', 'gamesLost'], [SORT_DESC, SORT_DESC, SORT_ASC], [SORT_NUMERIC, SORT_NUMERIC, SORT_NUMERIC]);

        return $items;
    }

    public function getWinners(Tournament $tournament)
    {
        $standings = $this->getStandings($tournament);
        $winners = [];
        for ($i = 0; $i <= 2; $i++)
            $winners[$i+1] = ArrayHelper::getValue($standings, ["$i.team"]);

        return $winners;
    }
}