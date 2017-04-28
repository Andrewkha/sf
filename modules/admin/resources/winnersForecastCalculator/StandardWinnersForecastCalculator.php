<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/13/2017
 * Time: 4:19 PM
 */

namespace app\modules\admin\resources\winnersForecastCalculator;

use app\modules\admin\models\query\TournamentWinnerForecastQuery;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\TournamentWinnerForecast;
use app\modules\user\models\User;
use app\resources\dto\WinnersForecastItem;
use app\resources\StandingsInterface;
use app\traits\ContainerAwareTrait;
use app\modules\admin\models\Team;
use yii\helpers\ArrayHelper;

class StandardWinnersForecastCalculator implements WinnersForecastCalculatorInterface
{
    use ContainerAwareTrait;

    const WFE_TEAM_IN_WINNERS = 1;
    const WFE_TEAM_POSITION = 2;
    const WFE_ALL_3_WINNERS = 3;
    const WFE_TOTAL_POINTS = 4;
    const WFE_NO_FORECAST = 5;

    const POINTS_TEAM_IN_WINNERS = 10;
    const POINTS_TEAM_POSITION = 20;
    const POINTS_ALL_3_WINNERS = 20;
    const POINTS_NO_FORECAST = 0;

    protected $tournamentWinnerForecastQuery;
    protected $standings;

    public function __construct(TournamentWinnerForecastQuery $tournamentWinnerForecastQuery, StandingsInterface $standings)
    {
        $this->tournamentWinnerForecastQuery = $tournamentWinnerForecastQuery;
        $this->standings = $standings;
    }

    /**
     * @param Tournament $tournament
     * @param User $user
     * @return WinnersForecastItem[]|void
     */
    public function getWinnersForecastResult(Tournament $tournament, User $user)
    {
        if (!$tournament->isFinished())
            return;

        /** @var TournamentWinnerForecast[] $forecastedWinners */
        $forecastedWinners = $this->tournamentWinnerForecastQuery->whereUserTournament($user->id, $tournament->id)->all();

        if (empty($forecastedWinners)) {
            return;
        }

        /** @var Team[] $winners */
        $winners = $this->standings->getWinners($tournament);

        /** @var WinnersForecastItem[] $result */
        $result = [];
        $totalPoints = 0;

        foreach ($winners as $position => $winner) {

            if (isset($forecastedWinners[$position]) && $winner->id === $forecastedWinners[$position]->team_id) {
                $points = self::POINTS_TEAM_POSITION;
                $totalPoints += $points;
                $event = self::WFE_TEAM_POSITION;
                $description = "$position-е место команды $winner->team - ";

                unset($forecastedWinners[$position]);
                $result[] = $this->make(WinnersForecastItem::class, [$event, $description, $points]);
            } else {
                foreach ($forecastedWinners as $fPosition => $forecastedWinner) {
                    if ($winner->id === $forecastedWinner->team_id) {
                        $points = self::POINTS_TEAM_IN_WINNERS;
                        $totalPoints += $points;
                        $event = self::WFE_TEAM_IN_WINNERS;
                        $description = "Попадание в тройку призеров команды $winner->team - ";

                        unset($forecastedWinners[$fPosition]);
                        $result[] = $this->make(WinnersForecastItem::class, [$event, $description, $points]);
                    }
                }
            }
        }

        if (count($result) === 3 && array_unique(ArrayHelper::getColumn($result, 'eventCode')) === [self::WFE_TEAM_POSITION]) {
            $points = self::POINTS_ALL_3_WINNERS;
            $totalPoints += $points;
            $event = self::WFE_ALL_3_WINNERS;
            $description = "Дополнительный бонус за правильно угаданную тройку призеров - ";
            $result[] = $this->make(WinnersForecastItem::class, [$event, $description, $points]);
        }

        $result['totalPoints'] = $this->make(WinnersForecastItem::class, [self::WFE_TOTAL_POINTS, 'Всего дополнительных очков - ', $totalPoints]);

        return $result;
    }
}