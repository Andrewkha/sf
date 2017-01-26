<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 2:09 PM
 */

namespace app\modules\admin\repositories\exceptions;


class TypeMismatchException extends \Exception
{
    public $message = 'Передан аргумент неправильного типа';
}