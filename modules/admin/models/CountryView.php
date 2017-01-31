<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/31/2017
 * Time: 4:49 PM
 */

namespace app\modules\admin\models;

use app\modules\admin\repositories\CountryRepository;

class CountryView
{
    private $country;
    private $repository;

    public function __construct(CountryRepository $repository, Country $country = null)
    {
        $this->country = $country;
        $this->repository = $repository;
    }

}