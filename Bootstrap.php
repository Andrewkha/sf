<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/22/2017
 * Time: 2:31 PM
 */

namespace app;

use app\resources\SimpleStandings;
use app\resources\StandingsInterface;
use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $this->initContainer();
    }

    protected function initContainer()
    {
        $container = Yii::$container;

        //dto
        $container->set(resources\dto\StandingsItem::class);

        //Standings Interface
        $container->setSingleton(StandingsInterface::class, SimpleStandings::class);
    }
}