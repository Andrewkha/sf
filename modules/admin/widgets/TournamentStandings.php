<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/21/2017
 * Time: 12:56 PM
 */

namespace app\modules\admin\widgets;

use app\modules\admin\models\Tournament;
use app\resources\StandingsInterface;
use app\traits\ContainerAwareTrait;
use kartik\base\Widget;
use yii\data\ArrayDataProvider;

/**
 * Class TournamentStandings
 * @package app\modules\admin\widgets
 *
 * @property Tournament $tournament
 *
 */

class TournamentStandings extends Widget
{
    use ContainerAwareTrait;

    public $tournament;

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $items = $this->make(StandingsInterface::class)->getStandings($tournament);

        $models = new ArrayDataProvider([
            'allModels' => $items,
        ]);

        return $this->render('/widgets/standings', ['models' => $models, 'tournament' => $tournament]);

    }
}