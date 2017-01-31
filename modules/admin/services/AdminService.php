<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 2:43 PM
 */

namespace app\modules\admin\services;

use app\modules\admin\models\Country;
use app\modules\admin\models\Team;
use app\modules\admin\repositories\CountryRepository;
use app\modules\admin\repositories\TeamRepository;

class AdminService
{
    private $countryRepository;
    private $teamRepository;

    public function __construct(
        CountryRepository $countryRepository,
        TeamRepository $teamRepository
    )
    {
        $this->countryRepository = $countryRepository;
        $this->teamRepository = $teamRepository;
    }

    /*
     * Country manipulation
     */

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
        return $this->countryRepository->getClass();
    }

    /*
     * Team manipulation
     */

    /*
    * @param string $name
    * @param $country
    * @param $logo
    */

    public function addTeam($name, $country, $logo)
    {
        $team = Team::create($name, $country, $logo);
        $this->teamRepository->save($team);
    }
    /*
     * @param $id
     * @param string $name
     * @param $country
     * @param string $logo
     */
    public function editTeam($id, $name, $country, $logo)
    {
        $team = $this->findTeam($id);
        $team->editData($name, $country, $logo);
        $this->teamRepository->save($team);
    }

    public function deleteTeam($id)
    {
        $team = $this->findTeam($id);
        $this->teamRepository->delete($team);
    }

    /*
    * @param string $id
    * @return Team
    */
    public function findTeam($id)
    {
        return $this->teamRepository->find($id);
    }

    public function getARClassTeam()
    {
        return $this->teamRepository->getClass();
    }
}