<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/15/2017
 * Time: 5:29 PM
 */

namespace app\modules\admin\services;


use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\factory\MailFactory;
use app\modules\admin\models\query\ForecastRemindersQuery;
use app\modules\admin\models\query\GameQuery;
use app\modules\admin\models\Tournament;
use app\modules\admin\Module;
use app\modules\user\models\User;
use app\modules\admin\models\Game;
use app\modules\user\models\query\UserQuery;
use app\traits\ContainerAwareTrait;
use Yii;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class ForecastReminderService implements ServiceInterface
{
    use ContainerAwareTrait;

    const MODE_CONSOLE = 'console';
    const MODE_WEB = 'web';

    protected $tournament;
    protected $tour;

    /**
     * @var UserQuery;
     */
    protected $userQuery;

    /**
     * @var ForecastRemindersQuery
     */
    protected $forecastRemindersQuery;

    /** @var  GameQuery */
    protected $gameQuery;

    /**
     * Indicates whether the application is run in Web or Console mode
     * @var string $mode
     */
    protected $mode;

    /** @var Module */
    protected $module;

    /** @var  integer */
    protected $firstGameStarts;

    public function __construct(
        Tournament $tournament,
        $tour,
        UserQuery $userQuery,
        ForecastRemindersQuery $forecastRemindersQuery,
        GameQuery $gameQuery
    )
    {
        $this->tour = $tour;
        $this->userQuery = $userQuery;
        $this->forecastRemindersQuery = $forecastRemindersQuery;
        $this->tournament = $tournament;
        $this->gameQuery = $gameQuery;
        if (Yii::$app instanceof \yii\console\Application) {
            $this->mode = self::MODE_CONSOLE;
        } else if (Yii::$app instanceof \yii\web\Application) {
            $this->mode = self::MODE_WEB;
        } else
            throw new Exception('Wrong application format');
        $this->module = Yii::$app->getModule('admin');
        $this->firstGameStarts = $this->gameQuery->firstGameInTourDate($tournament->id, $tour);
    }

    public function run()
    {
        if (!$this->checkSchedule())
            return false;

        /** @var Game[] $games */
        $games = $this->gameQuery->whereTourInTournament($this->tournament->id, $this->tour)->with(['teamHome', 'teamGuest'])->all();

        /** @var User[] $recipients */
        $recipients = $this->userQuery
            ->tournamentNotificationsSubscribers($this->tournament->id)
            ->with(['forecasts' => function (ActiveQuery $query) use ($games) {
                $query->where(['in', 'game_id', ArrayHelper::getColumn($games, 'id')]);
            }])->all();

        $countGames = count($games);

        $emptyForecast = $this->getEmpty($recipients);
        $partialForecast = $this->getPartial($recipients, $countGames);

        foreach ($emptyForecast as $one) {
            /** @var MailService $mailService */
            $mailService = MailFactory::makeForecastReminderEmptyMailerService($one, $games, $this->firstGameStarts, $this->tour, $this->tournament);
            if (!$mailService->run())
                throw new Exception("Ошибка отправки напоминания на турнир $this->tournament->tournament, тур $this->tour пользователю $one->username");
        }
        //todo добавить запись в БД!!!

        foreach ($partialForecast as $one) {
            /** @var MailService $mailService */
            $mailService = MailFactory::makeForecastReminderPartialMailerService($one, $games, $this->firstGameStarts, $this->tour, $this->tournament);
            if (!$mailService->run())
                throw new Exception("Ошибка отправки напоминания на турнир $this->tournament->tournament, тур $this->tour пользователю $one->username");
        }

        return true;

    }

    /**
     * Checking if the user is eligible for the notification.
     * If the application is web we can send as many as we want
     * if application is console, sending not more than specified in the Module configuration $numberOfForecastReminders
     * @param User $user
     * @return bool
     */
    protected function ifEligible(User $user)
    {
        if ($this->mode === self::MODE_WEB) {
            return true;
        }

        if ($this->mode === self::MODE_CONSOLE) {
            return ($this->forecastRemindersQuery->whereUserTournamentTour($user->id, $this->tournament->id, $this->tour)->count() < $this->module->numberOfForecastReminders);
        }

        return false;
    }

    /**
     * Returns reminders eligible users with empty forecast for the tour from $forecasters array
     * @param User[] $forecasters
     * @return User[] array
     */
    protected function getEmpty($forecasters) {

        return array_filter($forecasters, function (User $element)  {
            return ($this->ifEligible($element) && count($element->forecasts) == 0);
        });
    }

    /**
     * Returns reminders eligible users with partial forecast for the tour from $forecasters array
     * @param User[] $forecasters
     * @param int $gamesInTour;
     * @return User[] array
     */
    protected function getPartial($forecasters, $gamesInTour) {

        return array_filter($forecasters, function (User $element) use ($gamesInTour) {
            $count = count($element->forecasts);
            return ($this->ifEligible($element) && $count > 0 && $count < $gamesInTour);
        });
    }

    protected function checkSchedule()
    {
        if ($this->mode === self::MODE_WEB)
            return true;

        if (($this->firstGameStarts > time() + $this->module->firstNotificationFrame['from'] && $this->firstGameStarts < time() + $this->module->firstNotificationFrame['to']) ||
            ($this->firstGameStarts > time() + $this->module->secondNotificationFrame['from'] && $this->firstGameStarts < time() + $this->module->secondNotificationFrame['to']))
            return true;
        else
            return false;
    }
}