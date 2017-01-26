<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 3:13 PM
 */

namespace app\modules\admin\forms;

use yii\base\Model;
use app\modules\admin\models\Country;

class CountryCreateEditForm extends Model
{
    public $country;

    private $countryObj = NULL;

    public function __construct(Country $country = NULL, $config = [])
    {
        if($country !== NULL)
            $this->countryObj = $country;
        parent::__construct();
    }

    public function init()
    {
        if(isset($this->countryObj))
            $this->country = $this->countryObj->country;
    }

    public function rules()
    {
        return [
            [['country'], 'required'],
            ['country', 'unique', 'targetClass' => 'app\modules\admin\models\Country', 'targetAttribute' => 'country', 'message' => 'Такая страна уже есть'],
            [['country'], 'string', 'max' => 50],
        ];
    }
}