<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/16/2017
 * Time: 4:06 PM
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\events\TournamentEvent;
use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\models\query\TournamentQuery;
use app\modules\admin\models\Tournament;
use app\modules\admin\events\ItemEvent;
use app\modules\admin\traits\ContainerAwareTrait;
use yii\log\Logger;
use yii\base\Exception;

/**
 * Class TournamentEditService
 * @package app\modules\admin\services
 */
class TournamentEditService implements ServiceInterface
{
    use ContainerAwareTrait;

    protected $form;
    protected $tournament;
    protected $logger;

    public function __construct(TournamentCreateEditForm $form, Tournament $tournament, Logger $logger)
    {
          $this->form = $form;
          $this->tournament = $tournament;
          $this->logger = $logger;
    }
    /**
     * @return bool
     */
    public function run()
    {
        $model = $this->form;
        /** @var Tournament $tournament */
        $tournament = $this->tournament;

        foreach ($model->getAttributes() as $attribute => $value) {
            if ($attribute !== 'id') {
                $tournament->$attribute = $value;
            }
        }

        $transaction = $tournament->getDb()->beginTransaction();

        $flag = $tournament->isSetToFinished();

        try {
            if(!$tournament->save()) {
                $transaction->rollBack();
                return false;
            }

            $tournament->trigger(ItemEvent::EVENT_AFTER_UPDATE, $this->make(ItemEvent::class, [$tournament]));
            $transaction->commit();
            if ($flag) {
                $tournament->trigger(TournamentEvent::EVENT_TOURNAMENT_FINISHED, $this->make(TournamentEvent::class, [$tournament]));
            }

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);

            return false;
        }
    }

}