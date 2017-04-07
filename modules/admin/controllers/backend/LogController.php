<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/7/2017
 * Time: 3:35 PM
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\search\LogSearch;
use app\traits\ContainerAwareTrait;
use yii\web\Controller;
use Yii;

class LogController extends Controller
{
    use ContainerAwareTrait;

    public function actionIndex()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}