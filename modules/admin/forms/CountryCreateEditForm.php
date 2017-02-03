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
    private $formState;

    const FORM_STATE_OPEN = 'opened';
    const FORM_STATE_CLOSED = 'closed';

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->formState = self::FORM_STATE_CLOSED;
    }

    public function rules()
    {
        return [
            [['country'], 'required', 'message' => 'Не может быть пустым'],
            [['country'], 'unique', 'targetClass' => Country::className(), 'targetAttribute' => 'country', 'message' => 'Такая страна уже есть'],
            [['country'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Страна',
        ];
    }

    public function setFormState($state)
    {
        $this->formState = $state;
    }

    public function getFormState()
    {
        return $this->formState;
    }
}