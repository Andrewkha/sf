<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 2:43 PM
 */

namespace app\modules\admin\services;

use app\modules\admin\models\Country;
use app\modules\admin\repositories\CountryRepository;

class AdminService
{
    private $countryRepository;

    public function __construct(
        CountryRepository $countryRepository
    )
    {
        $this->countryRepository = $countryRepository;
    }

    /*
     * @param string $name
     */
    public function addCountry($name)
    {
        $country = Country::create($name);
        $this->countryRepository->save($country);
    }
}