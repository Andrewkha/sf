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
    /*
     * @param $id
     * @param string $name
     */
    public function editCountry($id, $name)
    {
        $country = $this->findCountry($id);
        $country->editData($name);
        $this->countryRepository->save($country);
    }

    public function deleteCountry($id)
    {
        $country = $this->findCountry($id);
        $this->countryRepository->delete($country);
    }

    /*
    * @param string $id
    * @return Country
    */
    public function findCountry($id)
    {
        return $this->countryRepository->find($id);
    }

    public function getARClassCountry()
    {
        return $this->countryRepository->getCountryClass();
    }
}