<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/7/2017
 * Time: 1:14 PM
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use app\traits\ContainerAwareTrait;
use app\modules\admin\forms\NewzCreateEditForm;
use app\modules\admin\models\Newz;
use yii\log\Logger;
use app\modules\admin\events\ItemEvent;
use yii\base\Exception;

class NewzEditService implements ServiceInterface
{
    use ContainerAwareTrait;

    protected $form;
    protected $news;
    protected $logger;
    protected $user_id;

    public function __construct(NewzCreateEditForm $form, Newz $news, $user_id, Logger $logger)
    {
        $this->form = $form;
        $this->news = $news;
        $this->logger = $logger;
        $this->user_id = $user_id;
    }

    public function run()
    {
        $model = $this->form;
        /** @var Newz $news */
        $news = $this->news;

        foreach ($model->getAttributes() as $attribute => $value) {
            if ($attribute !== 'id') {
                $news->$attribute = $value;
            }
        }
        $news->user_id = $this->user_id;
        if ($model->isSend == 1)
            $news->scenario = Newz::SCENARIO_SEND;

        $transaction = $news->getDb()->beginTransaction();
        try {
            if(!$news->save()) {
                $transaction->rollBack();
                return false;
            }

            $news->trigger(ItemEvent::EVENT_AFTER_CREATE, $this->make(ItemEvent::class, [$news]));
            $transaction->commit();

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->logger->log($e->getMessage(), Logger::LEVEL_ERROR);

            return false;
        }
    }
}