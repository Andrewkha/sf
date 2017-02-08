<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/8/2017
 * Time: 5:38 PM
 */

namespace app\modules\admin\events;

use app\modules\admin\models\Tournament;
use yii\base\Event;

class TournamentEvent extends Event
{
    const EVENT_TOURNAMENT_FINISHED = 'tournamentFinished';

    protected $tournament;

    public function __construct(Tournament $tournament, array $config = [])
    {
        $this->tournament = $tournament;
        parent::__construct($config);
    }

    public function getTournament()
    {
        return $this->tournament;
    }
}