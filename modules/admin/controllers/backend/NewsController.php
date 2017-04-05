<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 12:10 PM
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\search\NewzSearch;
use app\traits\ContainerAwareTrait;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

class NewsController extends Controller
{
    use ContainerAwareTrait;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new NewzSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}