<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 19.02.2017
 * Time: 14:08
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\models\query\TeamQuery;
use app\modules\admin\models\query\TournamentQuery;
use app\modules\admin\models\Tournament;
use yii\base\Exception;
use yii\log\Logger;

class AddParticipantService implements ServiceInterface
{
    protected $logger;
    protected $tournament;
    protected $teamQuery;
    protected $teams;

    public function __construct(Tournament $tournament, $participants, TeamQuery $teamQuery, Logger $logger)
    {
        $this->logger = $logger;
        $this->teamQuery = $teamQuery;
        $this->teams = $this->teamQuery->andWhere(['in', 'id',$participants])->all();
        $this->tournament = $tournament;
    }

    public function run()
    {
        $transaction = $this->tournament->getDb()->beginTransaction();
        try {
            foreach ($this->teams as $team) {
                $this->tournament->link('teams', $team);
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);
            return false;
        }
    }
}