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
    const MODE_ADMIN = 1;
    const MODE_USER = 0;
    const MODE_NEWZ = 2;

    use ContainerAwareTrait;

    public $tournament;
    public $mode;
    protected $standings;

    public function __construct(StandingsInterface $standings, array $config = [])
    {
        parent::__construct($config);
        $this->standings = $standings;
    }

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $items = $this->standings->getStandings($tournament);

        $models = new ArrayDataProvider([
            'allModels' => $items,
        ]);

        return $this->render('/widgets/standings', ['models' => $models, 'tournament' => $tournament, 'mode' => $this->mode]);

    }
}