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
use yii\base\Exception;
use yii\log\Logger;
use yii\web\NotFoundHttpException;

class AddParticipantService implements ServiceInterface
{
    protected $logger;
    protected $tournament;
    protected $tournamentQuery;
    protected $teamQuery;
    protected $teams;

    public function __construct($idTournament, $participants, TeamQuery $teamQuery, TournamentQuery $tournamentQuery, Logger $logger)
    {
        $this->logger = $logger;
        $this->tournamentQuery = $tournamentQuery;
        $this->teamQuery = $teamQuery;
        $this->teams = $this->teamQuery->andWhere(['in', 'id',$participants])->all();
        $this->tournament = $tournamentQuery->where(['id' => $idTournament])->one();
        if (!$this->tournament)
            throw new NotFoundHttpException('Такого турнира не существует');
    }

    public function run()
    {
        $transaction = $this->tournament->getDb()->beginTransaction();
        try {
            foreach ($this->teams as $team) {
                if(!$this->tournament->link('teams', $team)) {
                    $transaction->rollBack();
                    return false;
                };
                $transaction->commit();
                return true;
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);
            return false;
        }
    }
}