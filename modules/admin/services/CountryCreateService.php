<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 10:44 AM
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use app\modules\admin\events\CountryEvent;
use app\modules\admin\models\Country;
use yii\base\Exception;
use yii\log\Logger;
use Yii;

class CountryCreateService implements ServiceInterface
{
    protected $model;
    protected $logger;

    public function __construct(Country $model, Logger $logger)
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

            $model->trigger(CountryEvent::EVENT_AFTER_CREATE);
            $transaction->commit();

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);
            Yii::$app->session->setFlash('error', $e->getMessage());

            return false;
        }
    }
}