<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 22.02.2017
 * Time: 21:54
 */

namespace app\modules\admin\widgets;

use app\modules\admin\models\query\GameQuery;
use app\resources\dto\ForecastStandingsItem;
use app\resources\ForecastStandingsInterface;
use app\traits\ContainerAwareTrait;
use kartik\base\Widget;
use app\modules\admin\models\Tournament;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class TournamentForecasters extends Widget
{
    use ContainerAwareTrait;

    const MODE_SIMPLE = 0;
    const MODE_EXTENDED = 1;

    public $tournament;

    /** @var  ForecastStandingsItem[] */
    public $items;
    public $mode = self::MODE_EXTENDED;

    protected $gameQuery;

    public function __construct(GameQuery $gameQuery, array $config = [])
    {
        $this->gameQuery = $gameQuery;
        parent::__construct($config);
    }

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $models = new ArrayDataProvider([
            'allModels' => $this->items,
        ]);
        if ($this->mode === self::MODE_EXTENDED) {

            $games = $this->gameQuery->whereTournament($tournament->id)->with(['teamHome', 'teamGuest'])->indexBy('id')->all();

            $games = array_map(function ($item) {
                return new ArrayDataProvider([
                    'allModels' => $item,
                    'sort' => [
                        'attributes' => ['date'],
                        'defaultOrder' => [
                            'date' => SORT_ASC,
                        ]
                    ]
                ]);
            }, ArrayHelper::index($games, 'id', 'tour'));

            return $this->render('/widgets/forecastStandings', ['models' => $models, 'tournament' => $tournament, 'games' => $games]);
        } else {

            return $this->render('/widgets/forecastStandingsSimple', ['models' => $models, 'tournament' => $tournament]);
        }
    }
}