<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/13/2017
 * Time: 8:47 PM
 */

namespace app\resources\dto;


class WinnersForecastItem
{
    public $eventCode;
    public $eventMessage;
    public $eventPoints;

    public function __construct($eventCode, $eventMessage, $eventPoints)
    {
        $this->eventCode = $eventCode;
        $this->eventMessage = $eventMessage;
        $this->eventPoints = $eventPoints;
    }
}