<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 12:50 PM
 */

namespace app\modules\admin\contracts;


interface ServiceInterface
{
    /**
     * @return bool
     */
    public function run();
}