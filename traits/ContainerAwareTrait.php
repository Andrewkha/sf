<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 10:29 AM
 */

namespace app\traits;

use Yii;

trait ContainerAwareTrait
{

    public function getDi()
    {
        return Yii::$container;
    }

    /**
     * Gets a class from the container.
     *
     * @param string $class  he class name or an alias name (e.g. `foo`) that was previously registered via [[set()]]
     *                       or [[setSingleton()]]
     * @param array  $params constructor parameters
     * @param array  $config attributes
     *
     * @return object
     */

    public function make($class, $params = [], $config = [])
    {
        return $this->getDi()->get($class, $params, $config);
    }
}