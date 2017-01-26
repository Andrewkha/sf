<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 9:48 AM
 */

namespace app\modules\admin\repositories\exceptions;


class NotFoundException extends \DomainException
{
    protected $message = 'Запись не найдена';
}