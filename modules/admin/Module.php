<?php

namespace app\modules\admin;

use yii\base\Module as BaseModule;
/**
 * admin module definition class
 */
class Module extends BaseModule
{
    /**
     * @var integer when set not started tournament to started
     */
    public $daysSetTournamentToStarted = 60*60*24*5;

    /**
     * @var int how many automatic reminders about missing/not complete forecast
     */
    public $numberOfForecastReminders = 2;

    /**
     * @var array timeframe for sending the secondnotification
     */
    public $secondNotificationFrame = ['from' => 60*60*24*3, 'to' => 60*60*24*2];

    /**
     * @var array timeframe foe sending the first notification
     */
    public $firstNotificationFrame = ['from' => 60*60*24*4, 'to' => 60*60*24*5];
}
