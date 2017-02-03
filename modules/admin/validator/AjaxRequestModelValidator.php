<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/3/2017
 * Time: 12:41 PM
 */

namespace app\modules\admin\validator;


use app\modules\admin\contracts\ValidatorInterface;
use yii\base\Model;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class AjaxRequestModelValidator implements ValidatorInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function validate()
    {
        $request = Yii::$app->request;

        if ($request->getIsAjax() && !$request->getIsPjax()) {
            if ($this->model->load($request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode(ActiveForm::validate($this->model));
                Yii::$app->end();
            }
        }
    }
}
