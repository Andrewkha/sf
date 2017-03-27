<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 27.03.2017
 * Time: 16:50
 */

namespace app\modules\admin\events;

use app\modules\admin\models\Tournament;
use yii\base\Event;

class TourEvent extends Event
{
    const EVENT_TOUR_FINISHED = 'tourFinished';

    /** @var  Tournament $tournament */
    protected $tournament;
    protected $tour;

    public function __construct(Tournament $tournament, $tour, array $config = [])
    {
        $this->tournament = $tournament;
        $this->tour = $tour;
        parent::__construct($config);
    }

    public function getTournament()
    {
        return $this->tournament;
    }

    public function getTour()
    {
        return $this->tour;
    }
}