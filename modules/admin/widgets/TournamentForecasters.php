<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 22.02.2017
 * Time: 21:54
 */

namespace app\modules\admin\widgets;

use app\modules\admin\models\query\GameQuery;
use app\resources\ForecastStandingsInterface;
use app\traits\ContainerAwareTrait;
use kartik\base\Widget;
use app\modules\admin\models\Tournament;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class TournamentForecasters extends Widget
{
    use ContainerAwareTrait;

    public $tournament;
    protected $gameQuery;

    protected $forecastStandings;

    public function __construct(GameQuery $gameQuery, ForecastStandingsInterface $forecastStandings, array $config = [])
    {
        $this->gameQuery = $gameQuery;
        $this->forecastStandings = $forecastStandings;
        parent::__construct($config);
    }

    public function run()
    {
        /** @var Tournament $tournament */
        $tournament = $this->tournament;
        $items = $this->forecastStandings->getStandings($tournament);

        $games = $this->gameQuery->whereTournament($tournament->id)->with(['teamHome', 'teamGuest'])->indexBy('id')->all();

        $models = new ArrayDataProvider([
            'allModels' => $items,
        ]);

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
    }
}