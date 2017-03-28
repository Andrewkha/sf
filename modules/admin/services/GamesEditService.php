<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 27.03.2017
 * Time: 15:29
 */

namespace app\modules\admin\services;

use app\modules\admin\events\TourEvent;
use app\modules\admin\models\Game;
use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\query\TournamentQuery;
use app\modules\admin\models\query\TourresultnotificationQuery;
use app\modules\admin\models\Tourresultnotification;
use app\traits\ContainerAwareTrait;
use yii\log\Logger;
use yii\base\Exception;
use app\modules\admin\models\Tournament;

class GamesEditService implements ServiceInterface
{

    /** @var  Game[] $games */
    protected $games;

    /** @var  Logger $logger */
    protected $logger;

    protected $tour;

    protected $tournament;

    /** @var   GameQuery $gameQuery*/
    protected $gameQuery;

    /** @var  TournamentQuery $tournamentQuery */
    protected $tournamentQuery;

    /** @var  TourresultnotificationQuery $tourNotificationQuery*/
    protected $tourNotificationQuery;

    use ContainerAwareTrait;

    public function __construct(array $games, $tournament, $tour, Logger $logger,
                                GameQuery $gameQuery,
                                TournamentQuery $tournamentQuery,
                                TourresultnotificationQuery $tourresultnotificationQuery
    )
    {
        $this->games = $games;
        $this->tour = $tour;
        $this->logger = $logger;
        $this->tournament = Tournament::findOne($tournament);
        $this->gameQuery = $gameQuery;
        $this->tournamentQuery = $tournamentQuery;
        $this->tourNotificationQuery = $tourresultnotificationQuery;
    }

    public function run()
    {
        $transaction = Game::getDb()->beginTransaction();

        try {
            foreach ($this->games as $game) {
                if(!$game->save()) {
                    $this->logger->log("Ошибка сохранениня игры $game->id. Вся транзакция отменена", Logger::LEVEL_ERROR);
                    $transaction->rollBack();
                    return false;
                }
            }
            $transaction->commit();

            if ($this->gameQuery->isTourFinished($this->tournament->id, $this->tour)  && (int)$this->tour === $this->tournament->tours)
                $this->tournament->setToFinished();
            elseif ($this->gameQuery->isTourFinished($this->tournament->id, $this->tour) && !$this->tourNotificationQuery->ifNotified($this->tournament->id, $this->tour)) {

                $this->tournament->trigger(TourEvent::EVENT_TOUR_FINISHED, $this->make(TourEvent::class, [$this->tournament, $this->tour]));
                /** @var Tourresultnotification $notification */
                $notification = new Tourresultnotification();
                $notification->tournament_id = $this->tournament->id;
                $notification->tour = $this->tour;
                $notification->save();
            }

            return true;

        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);
            return false;
        }
    }
}