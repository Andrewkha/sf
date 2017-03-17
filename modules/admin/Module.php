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
}
