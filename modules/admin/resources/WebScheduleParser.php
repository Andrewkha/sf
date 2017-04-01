<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 31.03.2017
 * Time: 16:22
 */

namespace app\modules\admin\resources;

use app\modules\admin\models\Game;
use app\modules\admin\models\query\ForecastQuery;
use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\Forecast;
use app\modules\admin\resources\parser\ChampionatPlayOffParser;
use app\modules\admin\resources\parser\ChampionatStandardParser;
use app\modules\admin\resources\parser\ParserInterface;
use app\modules\admin\resources\parser\SportsPlayOffParser;
use app\modules\admin\resources\parser\SportsStandardParser;
use app\traits\ContainerAwareTrait;
use yii\helpers\ArrayHelper;

class WebScheduleParser
{
    use ContainerAwareTrait;

    /** @var  Tournament */
    protected $tournament;

    /** @var  ParserInterface */
    protected $parser;

    /** @var  GameQuery */
    protected $gameQuery;

    /** @var  ForecastQuery */
    protected $forecastQuery;

    public function __construct(Tournament $tournament, GameQuery $gameQuery, ForecastQuery $forecastQuery)
    {
        $this->forecastQuery = $forecastQuery;
        $this->gameQuery = $gameQuery;
        $this->tournament = $tournament;
        $this->parser = self::getParser();
    }

    protected function getParser()
    {
        if (stripos($this->tournament->autoprocessURL, 'sports') !== false && $this->tournament->isRegular())
            return $this->make(SportsStandardParser::class);

        if (stripos($this->tournament->autoprocessURL, 'sports') !== false && $this->tournament->isPlayoff())
            return$this->make(SportsPlayOffParser::class);

        if (stripos($this->tournament->autoprocessURL, 'championat') !== false && $this->tournament->isRegular())
            return $this->make(ChampionatStandardParser::class);

        if (stripos($this->tournament->autoprocessURL, 'championat') !== false && $this->tournament->isPlayoff())
            return $this->make(ChampionatPlayOffParser::class);

        throw new \yii\base\Exception('Некорректный тип турнира');
    }

    protected function getGamesFromWeb()
    {
        return $this->parser->getGamesFromWeb($this->tournament);
    }

    protected function getGamesFromDb()
    {
        return $this->gameQuery->whereTournament($this->tournament->id)->andWhere(['>', 'date', time() - 60*60*24*7*2])->all();
    }

    /**
     * @param Game[] $webGames
     * @param Game[] $dbGames
     * @return array
     */
    protected function matchGames($webGames, $dbGames)
    {
        /** @var Game[] $toDb */
        $toDb = [];
        foreach ($dbGames as $dbGame) {
            foreach ($webGames as $key => $webGame) {
                if ($webGame->tour == $dbGame->tour && $webGame->teamHome_id == $dbGame->teamHome_id && $webGame->teamGuest_id == $dbGame->teamGuest_id) {
                    if ($dbGame->date != $webGame->date)
                        $dbGame->date = $webGame->date;

                    if ($dbGame->scoreHome != $webGame->scoreHome)
                        $dbGame->scoreHome = $webGame->scoreHome;

                    if ($dbGame->scoreGuest != $webGame->scoreGuest)
                        $dbGame->scoreGuest = $webGame->scoreGuest;

                    $dirty = $dbGame->getDirtyAttributes();
                    if(!empty($dirty))
                        $toDb[] = $dbGame;

                    $unset = ArrayHelper::remove($webGames, $key);
                    continue;
                }

                // if home and guest switched
                if ($webGame->tour == $dbGame->tour && $webGame->teamHome_id == $dbGame->teamGuest_id && $webGame->teamGuest_id == $dbGame->teamHome_id) {
                    $dbGame->switchHomeGuest();
                    if ($dbGame->date != $webGame->date)
                        $dbGame->date = $webGame->date;

                    //need to fix forecasts as well
                    /** @var Forecast[] $forecasts */
                    $forecasts = $this->forecastQuery->whereGame($dbGame->id)->all();

                    foreach ($forecasts as $forecast) {
                        $forecast->switchHomeGuest();
                        $forecast->save(false);
                    }

                    $toDb = $dbGame;
                    $unset = ArrayHelper::remove($webGames, $key);
                    continue;
                }
            }
        }

        $toDb = array_merge_recursive($toDb, $webGames);
        $toDb = ArrayHelper::index($toDb, null,'tour');

        return $toDb;
    }

    public function run()
    {
        $gamesFromWeb = $this->getGamesFromWeb();
        $gamesFromDb = $this->getGamesFromDb();

        return ($this->matchGames($gamesFromWeb, $gamesFromDb));
    }
}