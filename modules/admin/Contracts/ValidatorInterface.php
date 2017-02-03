<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 12:38 PM
 */

namespace app\modules\admin\contracts;


interface ValidatorInterface
{
    /**
     * @return bool
     */
    public function validate();
}