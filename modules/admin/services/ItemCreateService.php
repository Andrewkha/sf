<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 10:44 AM
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\events\ItemEvent;
use app\traits\ContainerAwareTrait;
use yii\db\ActiveRecord;
use yii\base\Exception;
use yii\log\Logger;

class ItemCreateService implements ServiceInterface
{
    use ContainerAwareTrait;

    protected $model;
    protected $logger;

    public function __construct(ActiveRecord $model, Logger $logger)
    {
        $this->model = $model;
        $this->logger = $logger;
    }

    public function run()
    {
        $model = $this->model;

        $transaction = $model->getDb()->beginTransaction();

        try {
            if(!$model->save()) {
                $transaction->rollBack();

                return false;
            }

            $transaction->commit();
            $model->trigger(ItemEvent::EVENT_AFTER_CREATE, $this->make(ItemEvent::class, [$model]));

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);

            return false;
        }
    }
}