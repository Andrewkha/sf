<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 12:30 PM
 */

namespace app\modules\admin\events;

use app\modules\admin\models\Country;
use yii\base\Event;

class CountryEvent extends Event
{

    const EVENT_AFTER_CREATE ='afterCreate';

    protected $country;

    public function __construct(Country $country, $config = [])
    {
        $this->country = $country;
        parent::__construct($config);
    }

    public function getCountry()
    {
        return $this->country;
    }
}