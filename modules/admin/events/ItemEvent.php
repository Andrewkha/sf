<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 12:30 PM
 */

namespace app\modules\admin\events;

use yii\db\ActiveRecord;
use yii\base\Event;

class ItemEvent extends Event
{
    const EVENT_AFTER_CREATE ='afterCreate';
    const EVENT_AFTER_UPDATE = 'afterUpdate';

    protected $model;

    public function __construct(ActiveRecord $model, $config = [])
    {
        $this->model = $model;
        parent::__construct($config);
    }

    public function getModel()
    {
        return $this->model;
    }
}