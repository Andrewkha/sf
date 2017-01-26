<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 2:45 PM
 */

namespace app\modules\admin;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    /*
     * @param \yii\base\Application $app
     */

    public function bootstrap($app)
    {
        $container = Yii::$container;
    }
}