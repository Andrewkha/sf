<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 3/16/2017
 * Time: 11:54 AM
 */

namespace app\modules\admin\commands;

use app\modules\admin\helpers\TournamentHelper;
use app\modules\admin\models\query\TournamentQuery;
use app\modules\admin\models\Tournament;
use app\modules\admin\Module;
use app\modules\admin\resources\WebScheduleParser;
use app\modules\admin\services\ForecastReminderService;
use app\modules\admin\services\TournamentStartService;
use app\traits\ContainerAwareTrait;
use yii\console\Controller;
use yii\log\Logger;
use yii\base\Exception;
use app\modules\admin\services\GamesEditService;

/**
 * Class TournamentController contains console commands for manipulating with Tournaments
 * @property TournamentQuery $tournamentQuery;
 * @package app\modules\admin\commands
 */
class TournamentController extends Controller
{
    use ContainerAwareTrait;

    protected $tournamentQuery;
    public $module;
    protected $logger;

    public function __construct($id, Module $module, TournamentQuery $tournamentQuery,Logger $logger, array $config = [])
    {
        $this->tournamentQuery = $tournamentQuery;
        $this->logger = $logger;
        parent::__construct($id, $module, $config);
    }

    public function actionSetToStarted()
    {
        /** @var Tournament[] $tournaments */
        $tournaments = $this->tournamentQuery->notStarted()->all();

        foreach ($tournaments as $tournament) {
            $firstGame = $tournament->starts;
            if (isset($firstGame) && ($firstGame - time() < $this->module->daysSetTournamentToStarted)) {
                try {
                    if (!$this->make(TournamentStartService::class, [$tournament])->run())
                        $this->logger->log("Ошибка при автоматическом изменении статуса турнира с 'Не начался' на 'Проходит' $tournament->tournament", Logger::LEVEL_ERROR, 'console');
                } catch (Exception $e) {
                    $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR, 'console');
                }
            }
        }

        return 0;
    }

    public function actionRemindForecast()
    {
        /** @var Tournament[] $tournaments */
        $tournaments = $this->tournamentQuery->inProgress()->all();
        foreach ($tournaments as $tournament) {
            $nextTour = TournamentHelper::getNextTour($tournament);
            try {
                if ($this->make(ForecastReminderService::class, [$tournament, $nextTour])->run())
                    $this->logger->log("Task Autoreminder for $tournament->tournament tour $nextTour has been executed", Logger::LEVEL_INFO, 'console');
            } catch (Exception $e) {
                $this->logger->log($tournament->tournament . ' ' . $e->getMessage(), Logger::LEVEL_ERROR, 'console');
            }
        }

        return 0;
    }

    public function actionAutoprocess()
    {
        /** @var Tournament[] $tournaments */
        $tournaments = $this->tournamentQuery->inProgress()->isAutoprocess()->all();

        foreach ($tournaments as $tournament) {
            try {
                $allGames = $this->make(WebScheduleParser::class, [$tournament])->run();
                foreach ($allGames as $tour => $games) {
                    if (!$this->make(GamesEditService::class, [$games, $tournament, $tour])->run())
                        throw new Exception("Ошибка автозагрузки $tour тура турнира " . $tournament->tournament);
                }
                $this->logger->log("Task Autoprocess for $tournament->tournament has been executed", Logger::LEVEL_INFO, 'console');
            } catch (Exception $e) {
                $this->logger->log($tournament->tournament . ' ' . $e->getMessage(), Logger::LEVEL_ERROR, 'console');
            }
        }

        return 0;
    }
}