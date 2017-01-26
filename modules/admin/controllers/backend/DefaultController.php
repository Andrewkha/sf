<?php

namespace app\modules\admin\controllers\backend;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        \Yii::$app->session->setFlash('growl', 'Hello!');
        return $this->render('index');
    }
}
