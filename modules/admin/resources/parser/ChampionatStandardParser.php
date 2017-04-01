<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 31.03.2017
 * Time: 16:26
 */

namespace app\modules\admin\resources\parser;


use app\modules\admin\models\Game;
use app\modules\admin\models\query\TeamTournamentQuery;
use app\modules\admin\models\Tournament;
use DiDom\Document;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class ChampionatStandardParser implements ParserInterface
{
    /** @var  TeamTournamentQuery */
    protected $teamTournamentQuery;

    public function __construct(TeamTournamentQuery $teamTournamentQuery)
    {
        $this->teamTournamentQuery = $teamTournamentQuery;
    }

    public function getGamesFromWeb(Tournament $tournament)
    {
        $aliases = ArrayHelper::map($this->teamTournamentQuery->tournamentParticipants($tournament->id)->all(), 'alias', 'team_id');
        $html = new Document($tournament->autoprocessURL, true);
        //$html = new Document('rfpl.htm', true);

        $table = $html->find('table.table.b-table-sortlist tbody')[0];

        $j = 0;
        $gamesFromWeb = [];

        foreach ($table->find('tr') as $row) {
            $time = $this->autoTimeToUnix($row->find('td.sport__calendar__table__date')[0]->text());
            if(($time < time()) || $time > time() + 60*60*4) {
                $home = $row->find('td.sport__calendar__table__teams a.sport__calendar__table__team')[0]->text();
                $guest = $row->find('td.sport__calendar__table__teams a.sport__calendar__table__team')[1]->text();

                if (key_exists($home, $aliases) && key_exists($guest, $aliases)) {
                    $game = new Game();
                    $game->tournament_id = $tournament->id;
                    $game->teamHome_id = (int)$aliases[$home];
                    $game->teamGuest_id = (int)$aliases[$guest];
                    $game->tour = $row->find('td.sport__calendar__table__tour')[0]->text();
                    $game->date = $this->autoTimeToUnix($row->find('td.sport__calendar__table__date')[0]->text());
                    $game->scoreHome = $this->calculateHomeScore($row->find('td.sport__calendar__table__result span.sport__calendar__table__result__left')[0]->text());
                    $game->scoreGuest = $this->calculateGuestScore($row->find('td.sport__calendar__table__result span.sport__calendar__table__result__right')[0]->text());

                    $gamesFromWeb[$j] = $game;
                    $j++;
                } else {
                    throw new Exception("Error during alias parsing $home or $guest");
                }
            }
        }

        return $gamesFromWeb;
    }

    private function calculateHomeScore($score)
    {
        return (trim($score) === '-')? NULL : (int)trim($score);
    }

    private function calculateGuestScore($score)
    {
        return (trim($score) === '-')? NULL : (int)trim($score);
    }

    protected function autoTimeToUnix($str)
    {
        $str = trim($str);

        $day = (int)substr($str, 0, 2);
        $str = trim(substr($str, 3));

        $month = (int)substr($str, 0, 2);
        $str = trim(substr($str, 3));

        $year = (int)substr($str, 0, 4);

        $str = trim(substr($str, 5));
        $hour = (int)substr($str, 0, 2);

        $str = trim(substr($str, 3));
        $min = (int)substr($str, 0, 2);

        return mktime($hour, $min , 0, $month, $day, $year);
    }
}