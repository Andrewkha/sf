<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/16/2017
 * Time: 12:50 PM
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\models\Tournament;
use yii\base\Exception;

class TournamentStartService implements ServiceInterface
{
    protected $tournament;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function run()
    {
        if (!$this->tournament->isNotStarted()) {
            return true;
        } elseif ($this->tournament->isFinished()) {
            throw new Exception('Турнир уже закончен');
        } else {
            return (bool) $this->tournament->updateAttributes(['status' => Tournament::STATUS_IN_PROGRESS]);
        }
    }
}